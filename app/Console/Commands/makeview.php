<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class makeview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates view blade files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $directory;

    protected $file;

    protected $folder;


    protected function Setdirectory(){
        return $this->directory = "resources/views/";
    }

    protected function getFile(){
         $file = $this->argument()['file'];
         if (strpos($file, '/') !== false) {
         $file = explode('/', $file);
     }
        return $file;

    }

    protected function setFolder($f){
        return $this->folder = $f."/";
    }
    protected function checkFolder($a){

        if (is_array($a)) {
        if (count($a)==2) {
            $this->setFolder( $a[0]);
         return $this->file = $a[1];

        }
    }
        else{
            return $this->file = $a;
        }
    }
    protected function fileName(){
        return $this->file.'.blade.php';
    }

    protected function destination($a){

        return $this->directory.$this->folder.$this->fileName();
    }
    public function __construct()
    {

        $this->Setdirectory();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public $content = "@extends('layouts.app')
@section('title','your title')
@section('content')

@endsection
@section('css')

@endsection
@section('js')

@endsection
    ";
    public function handle()
    {
        $a = $this->getFile();
        $this->checkFolder($a);
       if (Storage::disk('view')->put($this->destination($a),$this->content)) {
             $this->info("Generated Blade file !");
        }
     else{
        $this->error('Something went wrong!');
     }
    }
}
