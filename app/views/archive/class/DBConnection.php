<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    class DBConnection
    {
        function opencon()
        {
            return new PDO('mysql:host=localhost; dbname=archives','root', '');
        }

        function signup($name, $email, $password)
        {
            $con = $this->opencon();
            if($con->prepare("INSERT INTO users (fullname, email, password) VALUES (?,?, ?)")->execute([$name, $email, $password])){
                $query = "SELECT users.id, users.profile, users.fullname, users.email, users.password, roles.role 
                        FROM users
                        INNER JOIN roles ON roles.id = users.role_id WHERE email='".$email."' && password='".$password."'";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }
        }
        function check($email,$pass)
        {
            $con = $this->opencon();
            $query = "SELECT users.id, users.profile, users.fullname, users.email, users.password, roles.role 
                        FROM users
                        INNER JOIN roles ON roles.id = users.role_id WHERE email='".$email."'";
            
            $verify = $con->query($query)->fetch();

            $final = password_verify($pass, $verify['password']);
            
            // $query = "SELECT users.id, users.fullname, users.email, users.password, roles.role 
            //             FROM users
            //             INNER JOIN roles ON roles.id = users.role_id WHERE email='".$email."' && password='".$final."'";
            if($pass == $final) return $con->query($query)->fetch();
        }

        function insertAdmin($move, $profile, $fullname, $email, $password, $campus, $program, $dep, $role) {
            $con = $this->opencon();

            $result['message'] = "";
            $location = PATH.'/profile_pictures/';

            if($fullname == "" || $email == "" || $password == "") return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';

            if($profile == "" || file_exists($location.$profile)) {
                $sql = "INSERT INTO users (fullname, email, password, campus_id, program_id, dep_id, role_id)     
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $con->prepare($sql);
                $stmt->execute([$fullname, $email, $password, $campus, $program, $dep, $role]);
                $stmt->fetch();

                if($stmt->rowCount() > 0) {
                    return $result = '<div class="alert alert-success" role="alert">User inserted successfully.</div>';
                }
                else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
            }
            else {
                // $extension = pathinfo($profile, PATHINFO_EXTENSION);
                // var_dump($extension);
                // if($extension != 'jpg' || $extension != 'png' || $extension != 'JPG')
                //     return '<div class="alert alert-danger" role="alert">Please, choose a valid image file!</div>';
                // else{
                    if(move_uploaded_file($move, $location.$profile)) {
                        $sql = "INSERT INTO users (profile, fullname, email, password, campus_id, program_id, dep_id, role_id)     
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                        $stmt = $con->prepare($sql);
                        $stmt->execute([$profile, $fullname, $email, $password, $campus, $program, $dep, $role]);
                        $stmt->fetch();

                        if($stmt->rowCount() > 0) {
                            return $result = '<div class="alert alert-success" role="alert">User inserted successfully.</div>';
                        }
                        else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                    }
                // }  
            }
        }

        function updateAdmin($move, $prev_profile, $new_profile, $fullname, $email, $password, $campus, $program, $dep, $role, $id) {
            $con = $this->opencon();

            $result['message'] = "";  
            $location = PATH.'/profile_pictures/';

            if($fullname == "" || $email == "" || $password == "") return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';

            if($new_profile == "") {
                if( file_exists($location.$prev_profile)) {
                    $sql = 'UPDATE users SET fullname=?, email=?, password=?, campus_id=?, program_id=?, dep_id=?, role_id=?
                            WHERE id = ?';

                    $stmt = $con->prepare($sql);
                    $stmt->execute([$fullname, $email, $password, $campus, $program, $dep, $role, $id]);
                    $stmt->fetch();

                    if($stmt->rowCount() > 0) {
                        return $result = '<div class="alert alert-success" role="alert">User updated successfully.</div>';
                    }
                    else return $result = '<div class="alert alert-danger" role="alert">Oopss, seems like there is nothing to be updated! Please, try again!</div>';
                }
            }
            else {
                if(move_uploaded_file($move, $location.$new_profile)) {
                    if($prev_profile != "profile.png") unlink($location.$prev_profile);

                    $sql = 'UPDATE users SET profile=?, fullname=?, email=?, password=?, campus_id=?, program_id=?, dep_id=?, role_id=? WHERE id = ?';   

                    $stmt = $con->prepare($sql);
                    $stmt->execute([$new_profile, $fullname, $email, $password, $campus, $program, $dep, $role, $id]);
                    $stmt->fetch();

                    if($stmt->rowCount() > 0) {
                        return $result = '<div class="alert alert-success" role="alert">User updated successfully.</div>';
                    }
                    else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                }
                
            }
        }

        function deleteAdmin($id, $profile) {
            $con = $this->opencon();
            $sql = 'DELETE from users WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                unlink('../../profile_pictures/'.$profile);
                return $result = '<div class="alert alert-success" role="alert">User deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function getAdmins() {
            $con = $this->opencon();
            $sql = "SELECT users.id, users.fullname, users.email, roles.role, campuses.campus, departments.dep, programs.program  
                    FROM users
                    INNER JOIN campuses ON campuses.id = users.campus_id
                    INNER JOIN  departments ON departments.id = users.dep_id
                    INNER JOIN programs ON programs.id = users.program_id
                    INNER JOIN roles ON roles.id = users.role_id
                    WHERE users.role_id = 3";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }

        function getAdmin(){
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = "SELECT users.id, users.profile, users.fullname, users.email, users.password, campuses.campus, 
                    departments.dep, programs.program, roles.role 
                        FROM users
                        INNER JOIN campuses ON campuses.id = users.campus_id
                        INNER JOIN  departments ON departments.id = users.dep_id
                        INNER JOIN programs ON programs.id = users.program_id
                        INNER JOIN roles ON roles.id = users.role_id
                        WHERE users.id = ?";
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        function getRegularUsers() {
            $con = $this->opencon();
            $sql = "SELECT users.id, users.fullname, users.email, campuses.campus, departments.dep, programs.program  
                    FROM users
                    INNER JOIN campuses ON campuses.id = users.campus_id
                    INNER JOIN departments ON departments.id = users.dep_id
                    INNER JOIN programs ON programs.id = users.program_id
                    INNER JOIN roles ON roles.id = users.role_id
                    WHERE users.role_id = 1";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }

        function getRegularUser(){
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = "SELECT users.id, users.fullname, users.email, campuses.campus, departments.dep, programs.program  
                    FROM users
                    INNER JOIN campuses ON campuses.id = users.campus_id
                    INNER JOIN  departments ON departments.id = users.dep_id
                    INNER JOIN programs ON programs.id = users.program_id
                    WHERE users.id = ?";
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        function getUser($sql) {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        function updateUser($move, $prev_profile, $new_profile, $uname, $lname, $fname, $email, $campus, $program, $dep, $id) {
            $con = $this->opencon();

            $result['message'] = "";  

            $location = PATH.'/profile_pictures/';

            if($uname == "" || $email == "" || $lname == "" || $fname == "") {
                return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';
            }

            if($new_profile == "") {
                if(file_exists($location.$prev_profile)) {
                    if($prev_profile != "profile.png") $new_profile = $prev_profile;
                    $sql = 'UPDATE users SET profile=?, fullname=?, lastname=?, firstname=?, email=?, campus_id=?, program_id=?, dep_id=? WHERE id = ?';

                    $stmt = $con->prepare($sql);
                    $stmt->execute([$new_profile, $uname, $lname, $fname, $email, $campus, $program, $dep, $id]);
                    $stmt->fetch();

                    if($stmt->rowCount() > 0) {
                        return $result = '<div class="alert alert-success" role="alert">Information updated successfully.</div>';
                    }
                    else return $result = '<div class="alert alert-danger" role="alert">Oopss, seems like there is nothing to be updated! Please, try again!</div>';
                }
            }
            else {
                if(move_uploaded_file($move, $location.$new_profile)) {
                    if($prev_profile != "profile.png") unlink($location.$prev_profile);

                    $sql = 'UPDATE users SET profile=?, fullname=?, lastname=?, firstname=?, email=?, campus_id=?, program_id=?, dep_id=? WHERE id = ?';   
                    $stmt = $con->prepare($sql);
                    $stmt->execute([$new_profile, $uname, $lname, $fname, $email, $campus, $program, $dep, $id]);
                    $stmt->fetch();

                    if($stmt->rowCount() > 0) {
                        return $result = '<div class="alert alert-success" role="alert">Information updated successfully.</div>';
                    }
                    else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                } 
            }
        }

        function getProfile($id){
            $con = $this->opencon();
            $sql = 'SELECT profile FROM users WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
        function getDocuments() {
            $con = $this->opencon();
            $sql = "SELECT d.id, d.user_id, d.title, d.description, d.authors, s.state, d.filename, c.category, f.file, d.updated_at 
                    FROM documents AS d
                        INNER JOIN states AS s ON s.id = d.stat_id
                        INNER JOIN document_categories AS c ON c.id = d.doc_id
                        INNER JOIN  file_categories AS f ON f.id = d.file_id";

            $stmt = $con->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }

        function getDocument(){
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = "SELECT d.id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, c.category, f.file, d.uploaded_at , d.updated_at 
                    FROM documents AS d
                        INNER JOIN states AS s ON s.id = d.stat_id
                        INNER JOIN document_categories AS c ON c.id = d.doc_id
                        INNER JOIN  file_categories AS f ON f.id = d.file_id
                        WHERE d.id = ?";

            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        function insertDocument($move, $title, $description, $authors, $year, $pub, $status, $filename, $doc_id, $file_id, $uploaded, $updated){
            $con = $this->opencon();

            $result['message'] = "";

            if($title == "" || $authors == "" || $description == "") return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';   

            if($filename == "") return $result = '<div class="alert alert-danger" role="alert">Oopss, seems like you forgot to choose a file!</div>';    
            else{
                if(file_exists('../../documents/'.$filename))
                    return $result = '<div class="alert alert-danger" role="alert">The file you choose already exists!</div>';

                if(pathinfo($filename, PATHINFO_EXTENSION) != 'pdf')
                    return $result = '<div class="alert alert-danger" role="alert">Please, choose a PDF file only!</div>';
                else {
                    if(move_uploaded_file($move, '../../documents/'.$filename)) {
                        if($year != "" && $pub != ""){
                            $sql = "INSERT INTO documents (
                                    title, description, authors, pub_year, publisher, filename, doc_id, file_id, uploaded_at, updated_at
                                    )     
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con->prepare($sql);
                            $stmt->execute([$title, $description, $authors, $year, $pub, $filename, $doc_id, $file_id, $uploaded, $updated]);
                            $stmt->fetch();

                            if($stmt->rowCount() > 0) {
                                return $result = '<div class="alert alert-success" role="alert">Document added successfully.</div>';
                            }
                            else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                        }else{
                            $sql = "INSERT INTO documents (
                                    title, description, authors, filename, doc_id, file_id, uploaded_at, updated_at
                                    )     
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con->prepare($sql);
                            $stmt->execute([$title, $description, $authors, $filename, $doc_id, $file_id, $uploaded, $updated]);
                            $stmt->fetch();

                            if($stmt->rowCount() > 0) {
                                return $result = '<div class="alert alert-success" role="alert">Document added successfully.</div>';
                            }
                            else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                        }  
                    }
                }    
            }
        }

        function updateDocument($prev_filename, $move, $title, $description, $authors, $year, $pub, $status, $new_filename, $doc_id, $file_id, $updated, $id){
            $con = $this->opencon();

            $result['message'] = "";

            if($title == "" || $authors == "" || $description == "") return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';

            if($new_filename == "") {
                if(file_exists('../../documents/'.$prev_filename)) {
                    $sql = "UPDATE documents 
                            SET title=?, description=?, authors=?, pub_year=?, publisher=?, stat_id=?, doc_id=?, file_id=?, updated_at=? 
                            WHERE id = ?";

                    $stmt = $con->prepare($sql);
                    $stmt->execute([$title, $description, $authors, $year, $pub, $status, $doc_id, $file_id, $updated, $id]);
                    $stmt->fetch();

                    if($stmt->rowCount() > 0) {
                        return $result = '<div class="alert alert-success" role="alert">Document details updated successfully.</div>';
                    }
                    else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong! Please, try again!</div>';
                }     
            }else{
                if($new_filename != ""){    
                    if(pathinfo($new_filename, PATHINFO_EXTENSION) != 'pdf')
                        return $result = '<div class="alert alert-danger" role="alert">Please, choose a PDF file only!</div>';
                    else {
                        if(move_uploaded_file($move, '../../documents/'.$new_filename)) {
                            unlink('../../documents/'.$prev_filename);
                            $sql = "UPDATE documents 
                                    SET title=?, description=?, authors=?, pub_year=?, publisher=? stat_id=?, filename=?, doc_id=?, file_id=?, updated_at=? 
                                    WHERE id = ?";

                            $stmt = $con->prepare($sql);
                            $stmt->execute([$title, $description, $authors, $year, $pub, $status, $new_filename, $doc_id, $file_id, $updated, $id]);
                            $stmt->fetch();

                            if($stmt->rowCount() > 0) {
                                return $result = '<div class="alert alert-success" role="alert">Document details updated successfully.</div>';
                            }
                            else return $result = '<div class="alert alert-danger" role="alert">ooooooooOoops, something went wrong! Please, try again!</div>';
                        }
                    }
                }    
            }
        }

        function getStates() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM states';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getDocs() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM document_categories';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getDoc() {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = 'SELECT * FROM document_categories WHERE id =?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        function insertDocs($type) {
            $con = $this->opencon();
            $sql = 'INSERT INTO document_categories (category) VALUES (?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$type]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Document type added successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function updateDocs($type, $id) {
            $con = $this->opencon();
            $sql = 'UPDATE document_categories SET category = ? WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$type, $id]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Document type updated successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function deleteDocs($id) {
            $con = $this->opencon();
            $sql = 'DELETE from document_categories WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Document type deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function getFiles() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM file_categories';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getFile() {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = 'SELECT * FROM file_categories WHERE id =?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        function insertFile($file) {
            $con = $this->opencon();
            $sql = 'INSERT INTO file_categories (file) VALUES (?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$file]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">File category added successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function updateFile($file, $id) {
            $con = $this->opencon();
            $sql = 'UPDATE file_categories SET file = ? WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$file, $id]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">File category updated successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function deleteFile($id) {
            $con = $this->opencon();
            $sql = 'DELETE from file_categories WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">File category deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function getRoles() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM roles';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getCampuses() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM campuses';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getCampus() {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = 'SELECT * FROM campuses WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        function insertCampus($campus) {
            $con = $this->opencon();
            $sql = 'INSERT INTO campuses (campus) VALUES (?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$campus]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Campus added successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function updateCampus($campus, $id) {
            $con = $this->opencon();
            $sql = 'UPDATE campuses SET campus = ? WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$campus, $id]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Campus updated successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function deleteCampus($id) {
            $con = $this->opencon();
            $sql = 'DELETE from campuses WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Campus deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function getDepartments() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM departments';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getDepartment() {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = 'SELECT * FROM departments WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        function insertDepartment($dep) {
            $con = $this->opencon();
            $sql = 'INSERT INTO departments (dep) VALUES (?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$dep]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Department added successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function updateDepartment($dep, $id) {
            $con = $this->opencon();
            $sql = 'UPDATE departments SET dep = ? WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$dep, $id]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Department updated successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function deleteDepartment($id) {
            $con = $this->opencon();
            $sql = 'DELETE from departments WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Department deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function getPrograms() {
            $con = $this->opencon();
            $sql = 'SELECT * FROM programs';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function getProgram() {
            $con = $this->opencon();
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $sql = 'SELECT * FROM programs WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        function insertProgram($prog) {
            $con = $this->opencon();
            $sql = 'INSERT INTO programs (program) VALUES (?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$prog]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Program added successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function updateProgram($prog, $id) {
            $con = $this->opencon();
            $sql = 'UPDATE programs SET program = ? WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$prog, $id]);

            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">program updated successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        function deleteProgram($id) {
            $con = $this->opencon();
            $sql = 'DELETE from programs WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return $result = '<div class="alert alert-success" role="alert">Program deleted successfully.</div>';
            } else return $result = '<div class="alert alert-danger" role="alert">Ooops, something went wrong. Please try again.</div>';
        }

        // PDF Viewer
        function getPDF() {
            $id = !empty($_GET['id']) ? $_GET['id'] : '';
            $con = $this->opencon();
            $sql = 'SELECT * FROM documents WHERE id = ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $document = $stmt->fetch();

            return $document['filename'];
        }

        function get_cat_id($id){
            $con = $this->opencon();
            $query = "SELECT count(*) from documents AS d INNER JOIN document_categories as dc ON d.doc_id = dc.id where d.doc_id = $id";
            return $con->query($query)
                        ->fetchColumn();
        }

        function get_category(){
            $con = $this->opencon();
            $query = "SELECT * from document_categories";
            return $con->query($query)
                        ->fetchAll();
        }

        function getCount($query){
            $con = $this->opencon();
            return $con->query($query)
                        ->fetchColumn();
        }

        function addBookmark($doc_id, $user_id) {
            $con = $this->opencon();
            // $sql = 'SELECT b.user_id, b.doc_id FROM bookmarks AS b
            //         INNER JOIN users AS u ON u.id = b.user_id
            //         INNER JOIN documents AS d ON d.id = b.doc_id';
            // $s = $con->prepare($sql);
            // $s->execute();
            // $bookmarks = $s->fetchAll();
            // foreach ($bookmarks as $mark) {
            //     if($mark['user_id'] != $user_id && $mark['doc_id'] != $doc_id){
                    $query = 'INSERT INTO bookmarks (doc_id, user_id) VALUES (?, ?)';
                    $stmt = $con->prepare($query);
                    $stmt->execute([$doc_id,$user_id]);
                    if($stmt->rowCount()>0) return true;
                    else return false;
            //     }
            // }   
        }

        function myBookmarks($id) {
            $con = $this->opencon();
            $sql = "SELECT b.id, d.id, d.title, d.description, d.authors, d.pub_year, d.publisher
                    FROM bookmarks AS b INNER JOIN documents AS d ON d.id = b.doc_id 
                    INNER JOIN users AS u ON u.id = b.user_id 
                    WHERE b.user_id = ?";

            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }

        function deleteBookmark($id) {
            $con = $this->opencon();
            $sql = 'DELETE from bookmarks WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return true;
            } else return false;
        }

        function search($search){
            $con = $this->opencon();
            $sql = 'SELECT d.id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, dc.category, fc.file, d.uploaded_at , d.updated_at
                    FROM documents AS d 
                    INNER JOIN states AS s ON s.id = d.stat_id
                    INNER JOIN document_categories AS dc ON dc.id = d.doc_id
                    INNER JOIN file_categories AS fc ON fc.id = d.file_id
                    WHERE (d.title LIKE "%'.$search.'%" OR fc.file LIKE "%'.$search.'%") AND dc.id = d.doc_id'; 
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function addSubscribers($email) {
            $con = $this->opencon();
            if($email != ""){
                $query = 'INSERT INTO subscribers (email) VALUES (?)';
                $stmt = $con->prepare($query);
                $stmt->execute([$email]);
                if($stmt->rowCount()>0) {
                    $mail_to = "eliteresearcher@gmail.com";
                    $subject = "New Message Received";

                    // prepare email body text
                    $Body = '<h4 style="color: grey;">You just subscribe to our newsletter</h4>';
                    $Body .= '<a style="color: white; backgorund-color: green;" href="http://minsuarchive.000webhostapp.com" target="_blank"><button>Log In</button></a>';
                    $Body .= '<a style="color: black; backgorund-color: lightgrey;" href="http://minsuarchive.000webhostapp.com" target="_blank"><button>Sign Up</button></a>';
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = "true";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = "587";
                    $mail->Username = "eliteresearcher2021@gmail.com";
                    $mail->Password = "minsuarchive_2021";
                    $mail->Subject = $subject;
                    $mail->setFrom($mail_to);
                    $mail->Body = $Body;
                    $mail->IsHTML(true);
                    $mail->addAddress($email);

                    $success = $mail->Send();

                    if($success == true)
                        return true;
                }
                else return false;
            }
        }

        function deleteSub($id) {
            $con = $this->opencon();
            $sql = 'DELETE from subscribers WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return true;
            } else return false;
        }

        function generateCitation($id){
            $con = $this->opencon();
            $sql = 'SELECT d.id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, dc.category, fc.file, d.uploaded_at , d.updated_at
                    FROM documents AS d 
                    INNER JOIN states AS s ON s.id = d.stat_id
                    INNER JOIN document_categories AS dc ON dc.id = d.doc_id
                    INNER JOIN file_categories AS fc ON fc.id = d.file_id
                    WHERE d.id = ?'; 
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetch();

            $title = $res['title'];
            $str = $res['authors'];
            $year = date('Y', strtotime($res['pub_year']));
            $publisher = $res['publisher'];

            $words = str_word_count($str, 1, 'àáãç3');

            $count = count($words);

            if($publisher == "NONE"){
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.substr($words[1],0,1).'., & '.$words[2].', '.substr($words[3],0,1).'. ('.$year.'). '.$title.'.';
                            break;
                        }else{
                            return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., & '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'. ('.$year.'). '.$title.'.';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., & '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., & '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                    case 15: // Five Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'., & '.$words[12].', '.substr($words[13],0,1).'. '.substr($words[14], 0, 1).'.  ('.$year.'). '.$title.'.';
                        break;
                    default: // One Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                }
            }
            else{
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.substr($words[1],0,1).'., & '.$words[2].', '.substr($words[3],0,1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                            break;
                        }else{
                            return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., & '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., & '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., & '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    case 15: // Five Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'., & '.$words[12].', '.substr($words[13],0,1).'. '.substr($words[14], 0, 1).'.  ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    default: // One Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'.</i>';
                        break;
                }
            }
        }

        function userInsertDocument($move, $user_id, $title, $description, $authors, $year, $pub, $status, $filename, $doc_id, $file_id, $uploaded, $updated){
            $con = $this->opencon();

            $result['message'] = "";

            $location = PATH.'/documents/';

            if($title == "" || $authors == "" || $description == "") return $result = '<div class="alert alert-danger" role="alert">Please, fill all the field!</div>';   

            if($filename == "") return $result = '<div class="alert alert-danger" role="alert">Oopss, seems like you forgot to choose a file!</div>';    
            else{
                if(file_exists($location.$filename))
                    return $result = '<div class="alert alert-danger" role="alert">The file you choose already exists!</div>';

                if(pathinfo($filename, PATHINFO_EXTENSION) != 'pdf')
                    return $result = '<div class="alert alert-danger" role="alert">Please, choose a PDF file only!</div>';
                else {
                    if(move_uploaded_file($move, $location.$filename)) {
                        if($year != "" && $pub != ""){
                            $sql = "INSERT INTO documents (
                                    user_id, title, description, authors, pub_year, publisher, filename, doc_id, file_id, uploaded_at, updated_at
                                    )     
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con->prepare($sql);
                            $stmt->execute([$user_id, $title, $description, $authors, $year, $pub, $filename, $doc_id, $file_id, $uploaded, $updated]);
                            $stmt->fetch();

                            if($stmt->rowCount() > 0) {
                                return $result = '<div class="alert alert-success" role="alert">Document added successfully.</div>';
                            }
                            else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                        }else{
                            $sql = "INSERT INTO documents (
                                    user_id, title, description, authors, filename, doc_id, file_id, uploaded_at, updated_at
                                    )     
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con->prepare($sql);
                            $stmt->execute([$user_id, $title, $description, $authors, $filename, $doc_id, $file_id, $uploaded, $updated]);
                            $stmt->fetch();

                            if($stmt->rowCount() > 0) {
                                return $result = '<div class="alert alert-success" role="alert">Document added successfully.</div>';
                            }
                            else return $result = '<div class="alert alert-danger" role="alert">Oopss, something went wrong! Please, try again!</div>';
                        }  
                    }
                }    
            }
        }

        function saveCitation($user_id, $doc_id) {
            $con = $this->opencon();
            // $sql = 'SELECT c.user_id, c.doc_id FROM citations AS c
            //         INNER JOIN users AS u ON u.id = c.user_id
            //         INNER JOIN documents AS d ON d.id = c.doc_id';
            // $s = $con->prepare($sql);
            // $s->execute();
            // $bookmarks = $s->fetchAll();
            // if($s->rowCount() > 0){
            //     foreach ($bookmarks as $mark) {
            //     if($mark['user_id'] != $user_id && $mark['doc_id'] != $doc_id){
                    $query = 'INSERT INTO citations (user_id, doc_id) VALUES (?, ?)';
                    $stmt = $con->prepare($query);
                    $stmt->execute([$user_id, $doc_id]);
                    if($stmt->rowCount()>0) return true;
                    else return false;
            //     }
            // }   
            // }
            
        }

        function deleteCitation($id) {
            $con = $this->opencon();
            $sql = 'DELETE from citations WHERE id= ?';
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            if($stmt->rowCount() > 0) {
                return true;
            } else return false;
        }

        function myCitations($id) {
            $con = $this->opencon();
            $sql = "SELECT b.id, d.id, d.title, d.description, d.authors, d.pub_year, d.publisher
                    FROM citations AS b INNER JOIN documents AS d ON d.id = b.doc_id 
                    INNER JOIN users AS u ON u.id = b.user_id 
                    WHERE b.user_id = ?";

            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }

        function checkCitation($userid, $docid){
            $con = $this->opencon();
            $sql = 'SELECT c.user_id, c.doc_id FROM citations AS c
                    INNER JOIN users AS u ON u.id = c.user_id
                    INNER JOIN documents AS d ON d.id = c.doc_id
                    WHERE c.user_id = ? AND c.doc_id = ?';
            $s = $con->prepare($sql);
            $s->execute([$userid, $docid]);
            $s->fetch();

            if($s->rowCount() > 0) return true;
            else return false;
        }

        function checkCitationToDelete($userid, $docid){
            $con = $this->opencon();
            $sql = 'SELECT c.id, c.user_id, c.doc_id, c.cited FROM citations AS c
                    INNER JOIN users AS u ON u.id = c.user_id
                    INNER JOIN documents AS d ON d.id = c.doc_id
                    WHERE c.user_id = ? AND c.doc_id = ?';
            $s = $con->prepare($sql);
            $s->execute([$userid, $docid]);
            return $s->fetch();
        }

        function checkBookmarkToDelete($userid, $docid){
            $con = $this->opencon();
            $sql = 'SELECT c.id, c.user_id, c.doc_id FROM bookmarks AS c
                    INNER JOIN users AS u ON u.id = c.user_id
                    INNER JOIN documents AS d ON d.id = c.doc_id
                    WHERE c.user_id = ? AND c.doc_id = ?';
            $s = $con->prepare($sql);
            $s->execute([$userid, $docid]);
            return $s->fetch();
        }

        function checkBookmark($userid, $docid){
            $con = $this->opencon();
            $sql = 'SELECT c.user_id, c.doc_id FROM bookmarks AS c
                    INNER JOIN users AS u ON u.id = c.user_id
                    INNER JOIN documents AS d ON d.id = c.doc_id
                    WHERE c.user_id = ? AND c.doc_id = ?';
            $s = $con->prepare($sql);
            $s->execute([$userid, $docid]);
            $s->fetch();

            if($s->rowCount() > 0) return true;
            else return false;
        }

        function countDocCitations($id){
            $con = $this->opencon();
            $query = "SELECT count(*) FROM citationscopy AS c
                        INNER JOIN documents AS d ON d.id = c.doc_id
                        WHERE d.id = '".$id."' AND c.cited = 1";
            return $con->query($query)
                        ->fetchColumn();
        }

        function copyCitation($userid,$docid) {
            $db = $this->opencon();
            $sql = 'DELETE FROM citations WHERE user_id = ? AND doc_id = ?';
            $s = $db->prepare($sql);
            $s->execute([$userid, $docid]);
            if($s->rowCount() > 0)  return "Citation deleted.";
            else return "Please try again.";
        }
    }
?>
