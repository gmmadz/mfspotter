Skip to content
This repository
Search
Pull requests
Issues
Gist
 @gmmadz
 Watch 720
  Star 17,777
  Fork 3,780 select2/select2
 Code  Issues 444  Pull requests 69  Wiki  Pulse  Graphs
EditNew Page
PHP Example
Raees Iqbal edited this page on Aug 27, 2015 · 3 revisions
 Pages 7
Home
.Net MVC Example
ColdFusion
jqGrid integration
Knockout.js Integration
PHP Example
Socket.IO Integration
Clone this wiki locally


https://github.com/select2/select2.wiki.git
 Clone in Desktop
PHP example reposted from the Select2 discussion board.

<?php
/* add your db connector in bootstrap.php */
require 'bootstrap.php';

/*
$('#categories').select2({
        placeholder: 'Search for a category',
        ajax: {
            url: "/ajax/select2_sample.php",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    term: term, //search term
                    page_limit: 10 // page size
                };
            },
            results: function (data, page) {
                return { results: data.results };
            }

        },
        initSelection: function(element, callback) {
            return $.getJSON("/ajax/select2_sample.php?id=" + (element.val()), null, function(data) {

                    return callback(data);

            });
        }

    });
 */

$row = array();
$return_arr = array();
$row_array = array();

if((isset($_GET['term']) && strlen($_GET['term']) > 0) || (isset($_GET['id']) && is_numeric($_GET['id'])))
{

    if(isset($_GET['term']))
    {
        $getVar = $db->real_escape_string($_GET['term']);
        $whereClause =  " label LIKE '%" . $getVar ."%' ";
    }
    elseif(isset($_GET['id']))
    {
        $whereClause =  " categoryId = $getVar ";
    }
    /* limit with page_limit get */

    $limit = intval($_GET['page_limit']);

    $sql = "SELECT id, text FROM mytable WHERE $whereClause ORDER BY text LIMIT $limit";

    /** @var $result MySQLi_result */
    $result = $db->query($sql);

        if($result->num_rows > 0)
        {

            while($row = $result->fetch_array())
            {
                $row_array['id'] = $row['id'];
                $row_array['text'] = utf8_encode($row['text']);
                array_push($return_arr,$row_array);
            }

        }
}
else
{
    $row_array['id'] = 0;
    $row_array['text'] = utf8_encode('Start Typing....');
    array_push($return_arr,$row_array);

}

$ret = array();
/* this is the return for a single result needed by select2 for initSelection */
if(isset($_GET['id']))
{
    $ret = $row_array;
}
/* this is the return for a multiple results needed by select2
* Your results in select2 options needs to be data.result
*/
else
{
    $ret['results'] = $return_arr;
}
echo json_encode($ret);

$db->close();
Contact GitHub API Training Shop Blog About
© 2016 GitHub, Inc. Terms Privacy Security Status Help