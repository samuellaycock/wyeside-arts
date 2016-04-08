/**
 * @param id
 * @param username
 */
function deleteUser(id, username)
{
    var reallyDelete = confirm("Are you sure you would like to delete the user: " + username + "?");
    if(reallyDelete){
        $.ajax({
            method: 'DELETE',
            url: "/system/users/" + id,
            success: function(result){
                window.location.reload();
            }
        });
    }
}

/**
 * @param id
 */
function editUser(id)
{
    window.location.href = "/system/users/" + id + "/edit"
}