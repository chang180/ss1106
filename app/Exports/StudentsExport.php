<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class StudentsExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $students=Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->get();
        // dd($students);
        $result=new Collection;
        
        foreach($students as $student){
            // $hobbyArray=[];
            // foreach($student->hobbyRelation as $hobby){
            //     array_push($hobbyArray,$hobby->hobby);
            // }
            $hobby= new Collection;
            foreach($student->hobbyRelation as $hobbyItem){
                $hobby->push($hobbyItem->hobby);
            }
            // dd($hobby);
            $result->push([
                'id'=>$student->id,
                'photo'=>$student->photo,
                'name'=>$student->name,
                'chinese'=>$student->chinese,
                'english'=>$student->english,
                'math'=>$student->math,
                'location'=>$student->locationRelation->name,
                'phone'=>$student->phoneRelation->phone,
                'hobby'=>$hobby->implode(','),
            ]);
                
            // dd($result);
        }
        return $result;
        // return Student::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            '圖片',
            '姓名',
            '國文',
            '英文',
            '數學',
            '城市',
            '電話',
            '爱好',
        ];
    }
}
