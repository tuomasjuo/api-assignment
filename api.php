<?php
header("Content-Type: application/json");
include 'config.php';
include 'Employee.php';
$employeeHandler = new Employee($pdo);
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET': //Get employees
        
        if ($input === null) { //all employees
            $employees = $employeeHandler->getAllEmployees();
            if ($employees !== false) {
                echo json_encode($employees);
            } else {
                echo 'Database action failed';
            }
            
        } else { //employee by id
            $employee = $employeeHandler->getEmployeeById($input);
            if ($employee !== false) {
                echo json_encode($employee);
            } else {
                echo 'Database action failed';
            }
        }
        break;
        
    case 'POST': //Add employee
        if ($input !== null) {
            $success = $employeeHandler->addEmployee($input);

            if ($success === true) {
                echo 'User added successfully';
            } else {
                echo 'Database action failed';
            }
        } else echo 'Body null';
        break;

    case 'PUT': //Update employee's data
        if ($input !== null) {
            $success = $employeeHandler->updateEmployee($input);

            if ($success === true) {
                echo 'User updated successfully';
            } else {
                echo 'Database action failed';
            }
        } else echo 'Body null';
        break;

    case 'DELETE': //Delete employee's data
        if ($input !== null) {
            $success = $employeeHandler->deleteEmployee($input);
            
            if ($success === true) {
                echo 'User deleted successfully';
            } else {
                echo 'Database action failed';
            }
        } else echo 'Body null';
        break;

    default:
        echo 'Invalid request method';
        break;
}