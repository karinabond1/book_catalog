<?php
/**
 * Created by PhpStorm.
 * User: karin
 * Date: 16.01.2019
 * Time: 16:54
 */
include "Config.php";

class DB
{
    function connect()
    {
        $connect = mysql_pconnect(Config::$dbHost, Config::$dbUsername, Config::$dbPassword);
        if (!$connect) die ("Can not connect to MySQL");
        mysql_select_db('bookcatalog');
    }

    function selectAll($table_name)
    {
        $query = "SELECT * FROM `$table_name`";
        $q = mysql_query($query);
        $result = array();
        $index = 0;
        while ($row = mysql_fetch_assoc($q)) {
            $result[$index] = $row;
            $index++;
        }
        return $result;
    }

    function selectAllJoinOn($table_name1, $table_name2, $table1_column1, $table2_column1, $table2_column2, $table2_field)
    {
        $query = "SELECT * FROM `$table_name1` JOIN `$table_name2` ON `$table_name1`.`$table1_column1`= `$table_name2`.`$table2_column1` WHERE `$table_name2`.`$table2_column2`='$table2_field'";
        $q = mysql_query($query);
        $result = array();
        $index = 0;
        while ($row = mysql_fetch_assoc($q)) {
            $result[$index] = $row;
            $index++;
        }
        return $result;
    }

    function selectAllWhere($table_name, $table_column, $table_field)
    {
        $query = "SELECT * FROM `$table_name` WHERE `$table_column`='$table_field'";
        $q = mysql_query($query);
        $result = array();
        $index = 0;
        while ($row = mysql_fetch_assoc($q)) {
            $result[$index] = $row;
            $index++;
        }
        return $result;
    }

    function selectJoinOn($table1_field, $table_name1, $table_name2, $table1_column1, $table2_column1, $table2_field)
    {
        $query = "SELECT `$table1_field` FROM `$table_name1` JOIN `$table_name2` ON  `$table_name1`.`$table1_column1`=`$table_name2`.`$table2_column1` WHERE `$table_name2`.`$table2_column1`='$table2_field'";
        $q = mysql_query($query);
        $result = array();
        $index = 0;
        while ($row = mysql_fetch_assoc($q)) {
            $result[$index] = $row;
            $index++;
        }
        return $result;
    }

    function selectWhere($table_column1, $table_name, $table_column2, $table_field)
    {
        $query = "SELECT `$table_column1` FROM `$table_name` WHERE `$table_column2`='$table_field'";
        $q = mysql_query($query);
        $result = array();
        $index = 0;
        while ($row = mysql_fetch_assoc($q)) {
            $result[$index] = $row;
            $index++;
        }
        return $result;
    }

    function update($table_name, $table_column1, $table_field1, $table_column2, $table_field2, $table_column3, $table_field3, $table_column4, $table_field4, $table_column5, $table_field5)
    {
        $query = "UPDATE `$table_name` SET `$table_column1`='$table_field1',`$table_column2`='$table_field2',`$table_column3`='$table_field3',`$table_column4`='$table_field4' WHERE `$table_column5`= '$table_field5'";
        $result = mysql_query($query);
        if ($result) {
            ?><br>
            <p>DB is UPDATE</p>
            <?
        }
    }

    function selectWhereTwoPar($table_column1, $table_column2, $table_name, $table_field, $table_column3, $table_column4, $table_column5, $table_field3, $table_field4, $table_field5)
    {
        $connect = mysql_pconnect(Config::$dbHost, Config::$dbUsername, Config::$dbPassword);
        $query_book = "SELECT `$table_column1`,`$table_column2` FROM `$table_name` WHERE `$table_column2`='$table_field'";
        $result_book = mysql_query($query_book,$connect);
        if (mysql_num_rows($result_book) == 0) {
            $query = "INSERT INTO `$table_name` (`$table_column2`,`$table_column3`,`$table_column4`,`$table_column5`) VALUES ('$table_field','$table_field3','$table_field4','$table_field5')";
            $result = mysql_query($query);
            if ($result) {
                ?><br>
                <p>Book is added</p>
                <?
            }
        }
    }

    function insert($str, $book_id, $table_name1, $table1_column1, $table1_column2, $table_name2, $table2_column1, $table2_column2)
    {
        if ($str != "") {
            $query = "SELECT `$table1_column1` `$table1_column2` FROM `$table_name1` WHERE `$table1_column2`='$str'";
            $result = mysql_query($query);
            if (mysql_num_rows($result) == 0) {
                $query_add = "INSERT INTO `$table_name1` (`$table1_column2`) VALUES ('$str')";
                $result_add = mysql_query($query_add);
                if ($result_add) {
                    ?><br>
                    <p>Author or Genre is added</p>
                    <?
                }
            }

            $query_id = "SELECT `$table1_column1` FROM `$table_name1` WHERE `$table1_column2`='$str'";
            $result_id = mysql_query($query_id);
            $id = 0;
            while ($row = mysql_fetch_assoc($result_id)) {
                $id = $row['id'];
            }
            $query_book = "SELECT `$table2_column1` `$table2_column2` FROM `$table_name2` WHERE `$table2_column1`='$book_id' AND `$table2_column2`='$id'";
            $result_book = mysql_query($query_book);
            if (mysql_num_rows($result_book) == 0) {
                $query_books_something = "INSERT INTO `$table_name2` (`$table2_column1`,`$table2_column2`) VALUES ('$book_id','$id')";
                $result_books_something = mysql_query($query_books_something);
                if ($result_books_something) {
                    ?><br>
                    <p>Id book and id author or id genre are added</p>
                    <?
                }
            }
        }

    }

}