<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function all_users() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('tbl_student.*, tbl_course.course_name')
                 ->join('tbl_course', 'tbl_student.course_id = tbl_course.id', 'LEFT')
				 ->order_by('tbl_student.name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_student');

	}

    public function all_courses() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_course');

    }

    public function course_array() {

        $array = array();

		// these lines are preparing the
		// query to be run.
		$this->db->select('*');

		// run the query using the parameters
		// above and below.
		$results = $this->db->get('tbl_course')->result_array();

        foreach ($results as $item) {
            $array[$item['id']] = $item['course_name'];
        }

        return $array;
    }


    /*
    public function get_user($id) {

        //run a query and return the row immediately
        return $this->db->select('*')
                ->where('id', $id)
                ->get('tbl_student')
                ->row_array();
    }
    */

    public function add_user($name, $surname, $id_number, $email, $course_id) {

        $data = array(
            'name'          => $name,
            'surname'       => $surname,
            'id_number'     => $id_number,
            'email'         => $email,
            'course_id'     => $course_id
        );

        //An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_student', $data);

        //gives us whatever the primary key with auto increment value is
        return $this->db->insert_id();

    }
}
