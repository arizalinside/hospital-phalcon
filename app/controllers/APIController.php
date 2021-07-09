<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class APIController extends \Phalcon\Mvc\Controller
{
    public function getAction()
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isGet()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Patient::find();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function getByIdAction($patient_id)
    {

        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isGet()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Patient::find($patient_id);

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function postAction()
    {
        $this->view->disable();
        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isPost()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Add Patient Success",
            ];

            $data = $request->getPost();

            $patient = new Patient();
            $patient->patient_name      = $data["patient_name"];
            $patient->patient_sex       = $data["patient_sex"];
            $patient->patient_religion  = $data["patient_religion"];
            $patient->patient_phone     = $data["patient_phone"];
            $patient->patient_address   = $data["patient_address"];
            $patient->patient_nik       = $data["patient_nik"];

            $savedSuccessfully = $patient->save();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function putAction($patient_id)
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
        $response->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization');
        $response->setHeader("Access-Control-Allow-Credentials", true);

        $request = new Request();

        if ($request->isPut()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Update Patient Successfully",
            ];

            $patient = Patient::find($patient_id);

            $patients = $request->getPut();

            $patient->patient_id = $patient_id;
            $patient->patient_name = $patients["patient_name"];
            $patient->patient_religion = $patients["patient_religion"];
            $patient->patient_phone = $patients["patient_phone"];
            $patient->patient_address = $patients["patient_address"];
            $patient->patient_sex = $patients["patient_sex"];
            $patient->patient_nik = $patients["patient_nik"];

            $patient->update();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function deleteAction($patient_id)
    {

        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');

        $request = new Request();

        if ($patient_id) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Delete Patient Successfully",
            ];

            $patient = Patient::find($patient_id);
            $patient->delete();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }
}
