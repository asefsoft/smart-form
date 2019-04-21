<?php

namespace MyApp\Http\Controllers;

use Illuminate\Http\Request;

use MyApp\FilledForm;
use MyApp\Form;

class FormController extends Controller {

	private $saveResult = [];

    /**
     * Display list of all forms
     * @return \Illuminate\View\View
     */
    public function index(){
        $allForms = Form::select('id','title')->paginate(15);
        return view('index',compact('allForms'));
    }

    /**
     * Display new form creation page
     * @return \Illuminate\View\View
     */
	public function create() {
		return view('create');
	}

    /**
     * Display edit form page
     * @param $formID
     * @return \Illuminate\View\View
     */
	public function edit($formID) {
        $form = Form::findOrFail($formID,['id','title','questions']);
        return view('create',compact('form'));
    }

    /**
     * Store a form on db (Edited or New form)
     * POST request
     * @param Request $request
     * @return array
     */
	public function store(Request $request){

		if ($request.hasKey('action') && $request['action'] == 'saveForm') {
			$this->saveFormOnDB($request['formData']);
		}
		else {
			$this->setSaveResult('FAILED', 'Invalid action type');
		}
		return $this->saveResult;
	}


    /**
     * Delete a form
     * @param $formID
     * @return \Illuminate\Http\RedirectResponse
     */
	public function delete($formID) {
        $form = Form::find($formID);
        $result = $form->delete();
        return redirect()->back();
    }

	private function setSaveResult($status, $message, $formID = -1) {
		$this->saveResult = array('result'=>$status,
		                          'message'=>$message,
                                    'formID'=> $formID
			);
	}

    /**
     * create or update a form on db
     * @param $formData
     */
	private function saveFormOnDB($formData) {
		$formID = $formData['formID'];

		// create new form
		if ($formID == -1) {
			$form = new Form();
		}
		else { // save on form
            $form = Form::findOrFail($formID);
		}

        $form->title = $formData['formTitle'];
		if(isset($formData['formQuestions'])) {
            $form->questions = json_encode($formData['formQuestions']);
        }
        $form->save();

		$this->setSaveResult('OK', 'Form Saved' , $form->id);

	}


    /**
     * show all filled forms of selected form
     * @param $formID
     * @return \Illuminate\View\View
     */
	public function show_filled_forms($formID)
    {
        $form = Form::findOrFail($formID);
        $filledForms = Form::findOrFail($formID)->filled_forms ;
        return view('show_filled_forms',compact('filledForms','form'));
    }



    /**
     * ****************************
     *     Manage filled forms
     * ****************************
     */



    /**
     * Display filling form page
     * @param $formID
     * @return \Illuminate\View\View
     */
	public function show_fill($formID) {
        $form = Form::findOrFail($formID,['id','title','questions']);
        return view('create_fill', compact('form'));
    }



    /**
     * Store filled form on db
     * @param Request $request
     * @return array
     */
    public function store_fill(Request $request) {
        if ($request.hasKey('action') && $request['action'] == 'saveForm') {
            $this->saveFilledFormOnDB($request['formData']);
        }
        else {
            $this->setSaveResult('FAILED', 'Invalid action type');
        }
        return $this->saveResult;
    }


    /**
     * Display a filled form
     * @param $filledFormID
     * @return \Illuminate\View\View
     */
    public function show_filled_form($filledFormID)
    {
        $form = FilledForm::findOrFail($filledFormID);
        return view('show_filled_form',compact('form'));
    }

    /**
     * Delete a filled form
     * @param $formID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_filled_form($formID) {
        $form = FilledForm::find($formID);
        $result = $form->delete();
        return redirect()->back();
    }


    private function saveFilledFormOnDB($formData) {

	    // reference form
        $formID = $formData['formID'];

        $filledForm = new FilledForm();

        $filledForm->title = $formData['formTitle'];
        $filledForm->form_id = $formID; // set reference form (foreign key)

        if(isset($formData['formQuestions'])) {
            $filledForm->questions = json_encode($formData['formQuestions']);
        }

        $filledForm->save();

        $this->setSaveResult('OK', 'Filled Form Saved' , $filledForm->id);

    }


}

