<?php
class AnimalController extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new AnimalModel();
    }

    public function handleGetRequest() {
        if(isset($_GET['id'])){
            $animal = $this->model->read($_GET['id']);
        }else{
            if(isset($_GET['name'])){
                if(isset($_GET['year'])){
                    $animal = $this->model->search($_GET['name'], $_GET['year']);
                }else{
                    $animal = $this->model->search($_GET['name']);
                }
            } else {
                $animal = $this->model->search();
            }
        }
        
        if ($animal) {
            http_response_code(200);
            $this->setHeaders(['Content-Type' => 'application/json']);
            echo json_encode(['data' => $animal, 'message' => 'Sucess']);
        } else {
            http_response_code(404);
        }
    }

    public function handlePostRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);

        if ($input_data) {
            $animal = $this->model->create($input_data);

            if ($animal) {
                http_response_code(201);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($animal);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    }

    public function handlePutPatchRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);
        if ($input_data && isset($_GET['id'])) {
            $animal = $this->model->update($_GET['id'], $input_data);
            if ($animal) {
                http_response_code(200);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($animal);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    }

/*     public function handlePutRequest() {
        $input_data = json_decode(file_get_contents('php://input'), true);

        if ($input_data && isset($_GET['id'])) {
            $animal = $this->model->update($_GET['id'], $input_data);

            if ($animal) {
                http_response_code(200);
                $this->setHeaders(['Content-Type' => 'application/json']);
                echo json_encode($animal);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
    } */

    public function handleDeleteRequest() {
        if (isset($_GET['id'])) {
            $animal = $this->model->delete($_GET['id']);

            if ($animal) {
                http_response_code(204);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(400);
        }
    }
}
?>