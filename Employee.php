<?php
class Employee {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get all ememployees from the database.
     * @return array|false Return array of employees. Return false on failure
     */
    public function getAllEmployees() {
        $query = "SELECT * FROM employee";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute();
        if ($success === false) return false;
        $employees = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $employees;
    }

    /**
     * Get single employee's data by id from the database.
     * @param int $id Employee id
     * @return array|false Return array of employee's data. Return false on failure
     */
    public function getEmployeeById($data) {
        $id = $data['id'];

        $query = "SELECT * FROM employee WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute(['id' => $id]);
        if ($success === false) return false;
        $employee = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $employee;
    }

    /**
     * Adds an employee to the database.
     * @param array $data[ 'name', 'email', 'phone' ]
     * @return bool Return success
     */    
    public function addEmployee($data) {
        if ( //Check if all fields are filled
            !array_key_exists('name', $data) or 
            !array_key_exists('email', $data) or 
            !array_key_exists('phone', $data)
        ) return false;

        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];

        $query = "INSERT INTO employee (name, email, phone) VALUES (:name, :email, :phone)";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ]);
        return $success;
    }

    /**
     * Update employee's data on the database.
     * @param int $id
     * @param array $data[ 'name', 'email', 'phone' ] Requires all fields, even if only updating one.
     * @return bool Return success
     */       
    public function updateEmployee($data) {
        if ( //Check if all fields are filled
            !array_key_exists('id', $data) or 
            !array_key_exists('name', $data) or 
            !array_key_exists('email', $data) or 
            !array_key_exists('phone', $data)
        ) return false;

        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        
        $query = "UPDATE employee SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'id' => $id
        ]);

        return $success;
    }

    /**
     * Delete employee's data from the database.
     * @param int $id
     * @return bool Return success
     */  
    public function deleteEmployee($data) {
        if (!array_key_exists('id', $data)) return false; //check if id exists
        $id = $data['id'];

        $query = "DELETE FROM employee WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $success = $statement->execute(['id' => $id]);
        echo $success;
        echo $statement;

        return $success;
    }
}
?>