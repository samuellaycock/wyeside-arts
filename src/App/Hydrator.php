<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 *
 * The abstract hydrator adds some re-usable functionality to
 * our system's hydrators.  The class expects an HydratableInterface
 * object to be sent to the hydrate() method but we can typecast
 * the actual hydration methods with the specific object that we
 * require.
 */

namespace App;


use App\Util\StringUtil;


class Hydrator
{

    /**
     * The main method to be called, we expect an HydratableInterface
     * object.
     *
     * We iterate through the array of data set and perform a
     * hydration on each key value pair that we find.
     *
     * @param $object mixed
     * @param array $data
     * @return mixed
     **/
    public function hydrate($object, array $data)
    {
        foreach ($data as $field => $value) {
            $this->performHydration($object, $field, $value);
        }
        return $object;
    }


    /**
     * Hydration methods should be named in a consistent fashion,
     * this method looks for the expected method name and calls
     * it, if it exists.
     *
     * We perform a quick check here to ensure we don't look to
     * hydrate data with zero-length keys.
     *
     * Example method name:
     *      model field: status
     *      method name: hydrateStatus
     *
     * @param $object
     * @param $field
     * @param $value
     * @return null
     **/
    protected function performHydration($object, $field, $value)
    {
        $methodName = StringUtil::toCamel('set-' . $field, false);

        if (strlen($methodName) == 0) {
            return;
        }

        if (method_exists($object, $methodName)) {
            $object->$methodName($value);
        }
    }

}