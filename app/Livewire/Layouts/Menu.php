<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Menu extends Component
{
    public $menu;

    public function mount()
    {
        $this->menu = [
            [
                'type'  => 'menu-item',
                'icon'  => 'fas fa-tachometer-alt',
                'text'  => 'Dashboard',
                'route' => 'dashboard',
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Students',
                'icon'    => 'fas fa-user',
                'can'     => 'menu-student',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View students',
                        'route' => 'students.index',
                        'can'   => 'read student',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create student',
                        'route' => 'students.create',
                        'can'   => 'create student',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Promote students',
                        'route' => 'students.promote',
                        'can'   => 'promote student',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Manage promotions',
                        'route' => 'students.promotions',
                        'can'   => 'read promotion',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Classes',
                'icon'    => 'fas fa-chalkboard',
                'can'     => 'menu-class',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View Classes',
                        'route' => 'classes.index',
                        'can'   => 'read class',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create Class',
                        'route' => 'classes.create',
                        'can'   => 'create class',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View Class Groups',
                        'route' => 'class-groups.index',
                        'can'   => 'read class group',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create Class Group',
                        'route' => 'class-groups.create',
                        'can'   => 'create class group',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Sections',
                'icon'    => 'fas fa-landmark',
                'can'     => 'menu-section',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View sections',
                        'route' => 'sections.index',
                        'can'   => 'read section',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create section',
                        'route' => 'sections.create',
                        'can'   => 'create section',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Teachers',
                'icon'    => 'fas fa-user',
                'can'     => 'menu-teacher',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View teachers',
                        'route' => 'teachers.index',
                        'can'   => 'read teacher',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create teacher',
                        'route' => 'teachers.create',
                        'can'   => 'create teacher',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Semesters',
                'icon'    => 'fas fa-clock',
                'can'     => 'menu-semester',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View semesters',
                        'route' => 'semesters.index',
                        'can'   => 'read semester',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create semester',
                        'route' => 'semesters.create',
                        'can'   => 'create semester',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Subjects',
                'icon'    => 'fas fa-lightbulb',
                'can'     => 'menu-subject',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View subjects',
                        'route' => 'subjects.index',
                        'can'   => 'read subject',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create subject',
                        'route' => 'subjects.create',
                        'can'   => 'create subject',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Assign teacher to subjects',
                        'route' => 'subjects.assign-teacher',
                        'can'   => 'update subject',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Academic years',
                'icon'    => 'fas fa-calendar',
                'can'     => 'menu-academic-year',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View academic years',
                        'route' => 'academic-years.index',
                        'can'   => 'read academic year',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create academic year',
                        'route' => 'academic-years.create',
                        'can'   => 'create academic year',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Exams',
                'icon'    => 'fas fa-book-open',
                'can'     => 'menu-exam',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View Exams',
                        'route' => 'exams.index',
                        'can'   => 'read exam',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create Exam',
                        'route' => 'exams.create',
                        'can'   => 'create exam',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Manage Exam records',
                        'route' => 'exam-records.index',
                        'can'   => 'update exam record',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Exam tabulation sheet',
                        'route' => 'exams.tabulation',
                        'can'   => 'read exam',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Semester Result Sheet',
                        'route' => 'exams.semester-result-tabulation',
                        'can'   => 'read exam',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Academic Year Result Sheet',
                        'route' => 'exams.academic-year-result-tabulation',
                        'can'   => 'read exam',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Result Checker',
                        'route' => 'exams.result-checker',
                        'can'   => 'check result',
                    ],
                ],
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Grade Systems',
                'icon'    => 'fa fa-graduation-cap',
                'can'     => 'menu-grade-system',
                'submenu' => [
                    [
                        'type'  => 'menu-item',
                        'text'  => 'View Grading System',
                        'route' => 'grade-systems.index',
                        'can'   => 'read grade system',
                    ],
                    [
                        'type'  => 'menu-item',
                        'text'  => 'Create Grades',
                        'route' => 'grade-systems.create',
                        'can'   => 'create grade system',
                    ],
                ],
            ],
            [
                'type'  => 'menu-item',
                'text'  => 'View Logs',
                'route' => 'log-viewer.index',
                'icon'  => 'fa fa-sticky-note',
                //this menu item checks with roles for now so this prevents other non super users from viewing menu item
                'can' => 'view logs',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.layouts.menu');
    }
}
