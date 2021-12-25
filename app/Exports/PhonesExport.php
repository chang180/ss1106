<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PhonesExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromView
{   
    public function view():View
    {
        
        $students=Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->get();
        // dd($students);
        $result=new Collection;
        
        foreach($students as $student){
            $result->push([
                'name'=>$student->name,
                'phone'=>$student->phoneRelation->phone,
            ]);
        }
        // dd($result);
        return view('student.export_phones')->with(['students'=>$result]);
    }

}
