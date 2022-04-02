<?php
    class DBConnection
    {
        function opencon()
        {
            return new PDO('mysql:host=localhost; dbname=archives','root', '');
        }

        function get_cat_id($id){
            $con = $this->opencon();
            $query = "SELECT count(*) from documents AS d INNER JOIN document_categories as dc ON d.doc_id = dc.id where d.doc_id = $id";
            return $con->query($query)
                        ->fetchColumn();
        }
    }
?>
