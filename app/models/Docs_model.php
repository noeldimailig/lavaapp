
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Docs_model extends Model {
	public function __construct() {
        parent::__construct();
        $this->call->database();
    }

	public function count_research() {
		$con = [
			'dc.category' => 'Researches'
		];
		return $this->db->table('documents as d')
						->select_count('d.id')
						->inner_join('document_categories as dc', 'd.doc_id=dc.id')
						->where($con)->get();
	}

	public function count_thesis() {
		$con = [
			'dc.category' => 'Thesis'
		];
		return $this->db->table('documents as d')
						->select_count('d.id')
						->inner_join('document_categories as dc', 'd.doc_id=dc.id')
						->where($con)->get();
	}

	public function count_dissertation() {
		$con = [
			'dc.category' => 'Dissertations'
		];
		return $this->db->table('documents as d')
						->select_count('d.id')
						->inner_join('document_categories as dc', 'd.doc_id=dc.id')
						->where($con)->get();
	}

	public function count_capstone() {
		$con = [
			'dc.category' => 'Capstones'
		];
		return $this->db->table('documents as d')
						->select_count('d.id')
						->inner_join('document_categories as dc', 'd.doc_id=dc.id')
						->where($con)->get();
	}

    public function getDocuments(){
        return $this->db->table('documents as d')
						->select('d.id, d.user_id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, dc.category, f.file, d.updated_at')
						->inner_join('states as s', 's.id = d.stat_id')
						->inner_join('document_categories as dc', 'dc.id = d.doc_id')
						->get_all();
    }

	public function getUserDocuments($id){
        return $this->db->table('documents as d')
						->select('d.id, d.user_id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, dc.category, d.uploaded_at, d.updated_at')
						->inner_join('states as s', 's.id = d.stat_id')
						->inner_join('document_categories as dc', 'dc.id = d.doc_id')
						->where('d.user_id', $id)
						->get_all();
    }

	public function get_documents(){
        return $this->db->table('documents')
						->select('id, title, description, authors, filename, updated_at')
						->get_all();
    }

	public function getDocument($id){

		$condition = [
			'd.id' => $id
		];

        return $this->db->table('documents as d')
						->select('d.id, d.title, d.description,d.pub_year,d.publisher, d.authors, s.state, d.filename, dc.category, f.file, d.uploaded_at')
						->inner_join('states as s', 's.id = d.stat_id')
						->inner_join('document_categories as dc', 'dc.id = d.doc_id')
						->inner_join('file_categories as f', 'f.id = d.file_id')
						->where($condition)
						->get();
    }

	public function getFilename($id){

		$condition = [
			'd.id' => $id
		];

        return $this->db->table('documents as d')
						->select('d.filename')
						->where($condition)
						->get();
    }

	public function insert_document($user_id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $uploaded, $updated) {
		$data = [
			'user_id' => $user_id,
			'title' => $title,
			'description' => $desc,
			'authors' => $author,
			'pub_year' => $year,
			'publisher' => $publisher,
			'stat_id' => $status,
			'filename' => $filename,
			'doc_id' => $category,
			'uploaded_at' => $uploaded,
			'updated_at' => $updated
		];

		return $this->db->table('documents')->insert($data)->exec();
	}

	public function update_document_text($id, $title, $desc, $author, $year, $publisher, $status, $category, $file, $updated) {
		$data = [
			'title' => $title,
			'description' => $desc,
			'authors' => $author,
			'pub_year' => $year,
			'publisher' => $publisher,
			'stat_id' => $status,
			'doc_id' => $category,
			'file_id' => $file,
			'updated_at' => $updated
		];

		return $this->db->table('documents')->update($data)->where('id', $id)->exec();
	}

	public function update_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $file, $updated) {
		$data = [
			'title' => $title,
			'description' => $desc,
			'authors' => $author,
			'pub_year' => $year,
			'publisher' => $publisher,
			'stat_id' => $status,
			'filename' => $filename,
			'doc_id' => $category,
			'file_id' => $file,
			'updated_at' => $updated
		];

		return $this->db->table('documents')->update($data)->where('id', $id)->exec();
	}

	public function document_delete($id) {
		return $this->db->table('documents')->where('id', $id)->delete()->exec();
	}

	public function check_document($name) {
		return $this->db->table('documents')->select('filename')->where('filename', $name)->get();
	}

	public function getDocCategories() {
		return $this->db->table('document_categories')->get_all();
	}

	public function countCitations($id) {
		return $this->db->raw('SELECT count(*) FROM citationscopy AS c
							INNER JOIN documents AS d ON d.id = c.doc_id
							WHERE d.id = ? AND c.cited = 1', array($id));
	}

	public function countDocuments($id) {
		return $this->db->raw('SELECT count(d.id) from documents AS d INNER JOIN document_categories as dc ON dc.id = d.doc_id where dc.id = ?', array($id));
	}

	public function search($search) {
        return $this->db->table('documents as d')
                        ->select('d.id, d.title, d.description, d.authors, d.pub_year, d.publisher, s.state, d.filename, dc.category, fc.file, d.uploaded_at , d.updated_at')
                        ->inner_join('states as s' ,'s.id = d.stat_id')
                        ->inner_join('document_categories as dc', 'dc.id = d.doc_id')
                        ->inner_join('file_categories as fc', 'fc.id = d.file_id')
                        ->like('d.title', "%".$search."%")
                        ->or_like('fc.file', "%".$search."%")
                        ->where('dc.id', 'd.doc_id')
                        ->get_all();
    }
}
?>
