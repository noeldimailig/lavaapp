<!DOCTYPE html> 

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Elite Researcher</title> 
        <?php include(ROOT_DIR.'app\views\archive\admin\default\header.php'); ?>
        <style>
            @media print {
                .noprint, .noprint * {
                    display: none;!important;
                }
            }
        </style>
    </head> 
  
    <body onload="print()"> 
        <div class="container-fluid">
            <center>
                <h3 class="mt-3"><?= $data['title']; ?> Master Lists</h3><hr>
            </center>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <th>Title</th>
                        <th>Author(s)</th>
                        <th>Publication Date</th>
                        <th>Publisher</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['docs'] as $result) : ?>
                            <tr>
                                <td><?php echo $result['id']; ?></td>
                                <td><?php echo $result['title']; ?></td>
                                <td><?php echo $result['authors']; ?></td>
                                <td><?php echo $result['pub_year']; ?></td>
                                <td><?php echo $result['publisher']; ?></td>
                            </tr>
                        <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr></tr>
                </tfoot>
            </table>
        </div>
        <div class="container-fluid">
            <div class="noprint">
                <a href="<?php echo site_url('nav/manage'); ?>" role="button" class="btn btn-lg btn-warning rounded">Cancel Print</a>
            </div>
        </div>
        <?php include(ROOT_DIR.'app\views\archive\admin\default\footer.php'); ?>
    </body> 
</html> 
