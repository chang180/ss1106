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
        $students = Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->get();
        // dd($students);
        $result = new Collection;

        foreach ($students as $student) {
            // $hobbyArray=[];
            // foreach($student->hobbyRelation as $hobby){
            //     array_push($hobbyArray,$hobby->hobby);
            // }
            $total = $student->chinese + $student->math + $student->english;
            $average = round($total / 3);
            $hobby = new Collection;
            foreach ($student->hobbyRelation as $hobbyItem) {
                $hobby->push($hobbyItem->hobby);
            }
            // dd($hobby);
            $result->push([
                'id' => $student->id,
                'photo' => $student->photo,
                'name' => $student->name,
                'chinese' => $student->chinese,
                'english' => $student->english,
                'math' => $student->math,
                'total' => $total,
                'average' => $average,
                'rank' => 0,
                'location' => $student->locationRelation->name,
                'phone' => $student->phoneRelation->phone,
                'hobby' => $hobby->implode(','),
            ]);

            // dd($result);
        }
        // $sort = $result->sortByDesc('total');
        $sort = $result->sortBy([['total', 'desc']]);
        // dd($sort);
        $rank = 1;
        $previousValue = [];
        foreach ($sort as $key => $item) {
            // if ($key > 0 && $item['total'] == $sort[$key - 1]['total']) {
            if ($key > 0 && $item['total'] == $previousValue['total']) {
                $item['rank'] = $sort[$key - 1]['rank'];
            } else {
                $item['rank'] = $rank;
                $rank++;
            }
            $previousValue = $item;
            // $item['rank'] = $key + 1;
            // dd($item);
            $sort->put($key, $item);
        }
        return $sort;
        // return Student::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
            '??????',
        ];
    }
}
