<?php 
class Controller 
{
}


class Editor extends Controller
{


    public function __construct()
    {
        include ('app/view/test_xhtml.php');
        if ((isset($_GET['trigger'])) && ($_GET['trigger'] === 'store')) {
           $this->store();
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index() 
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store() 
    {
        echo "store";
    }

    /**
     * Display the specified resource.
     */
    public function show() 
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() 
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update() 
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete() 
    {

    }
}

function helix_admin_test_page() {
    new ProductController();

}