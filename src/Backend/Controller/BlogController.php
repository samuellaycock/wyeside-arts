<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;

use App\Model\Repo\PostRepo;
use App\Pagination\Pagination;


/**
 * Class BlogController
 * @package Backend\Controller
 */
class BlogController extends BackendController
{

    /**
     * @return PostRepo
     */
    protected function getPostRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Post');
    }


    public function indexAction()
    {
        if (null !== $this->app->request->get('page')) {
            $page = $this->app->request->get('page');
        } else {
            $page = 1;
        }

        if(null !== $this->app->request->get('search')){
            $search = $this->app->request->get('search');
        }else{
            $search = "";
        }

        $queryBuilder = $this->getPostRepo()->getQueryBuilder();
        $query = $queryBuilder
            ->where($queryBuilder->expr()->like('p.title', ':title'))
            ->orderBy('e.createdTs', 'DESC')
            ->setParameter('title', '%' . $search . '%')->getQuery();

        $pageinator = new Pagination($query, $this->app->request->getResourceUri());
        $data = ['eventsPaginated' => $pageinator->getPage($page)];

        if ($this->app->request->isAjax()) {
            $this->app->render('backend/blog/_posts-table.twig', $data);
        } else {
            $this->app->render('backend/blog/index.twig', $data);
        }
    }

}