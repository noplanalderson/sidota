<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_filter
{
	public function reportRules()
	{
      	$form_rules = [
                  ['field' => 'ticket_code',
                   'label' => 'Ticket Code',
                   'rules' => 'regex_match[/[A-Z0-9]+$/]|exact_length[8]',
                   'errors'=> array('alnum' => '{field} must be alpha numeric 8 characters')
                  ],
                  ['field' => 'date_activity',
                   'label' => 'Date Activity',
                   'rules' => 'required|regex_date',
                   'errors'=> array('regex_date' => '{field} must in YYYY-MM-DD format.')
                  ],
                  ['field' => 'location',
                   'label' => 'Location',
                   'rules' => 'trim|required|regex_match[/[a-zA-Z0-9 \/\-_+,]+$/]|max_length[80]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_+,].')
                  ],
                  ['field' => 'location_address',
                   'label' => 'Location Address',
                   'rules' => 'trim|max_length[255]|regex_match[/[a-zA-Z0-9 ()@\/\-_+,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 ()@\/\-_+,.].')
                  ],
                  ['field' => 'category_activity_id',
                   'label' => 'Category Activity',
                   'rules' => 'required|is_natural_no_zero',
                   'errors'=> array('is_natural_no_zero' => '{field} must integer.')
                  ],
                  ['field' => 'shift',
                   'label' => 'Shift',
                   'rules' => 'required|regex_match[/^(pagi|siang|malam|wfh)$/]',
                   'errors'=> array('regex_match' => '{field} value must Pagi/Siang/Malam/WFH')
                  ],
                  ['field' => 'tool[]',
                   'label' => 'Tools',
                   'rules' => 'trim|max_length[200]|regex_match[/[a-zA-Z0-9 \/\-_,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_,.].')
                  ],
                  ['field' => 'tool_owner[]',
                   'label' => 'Tool Owneer',
                   'rules' => 'trim|max_length[200]|regex_match[/[a-zA-Z0-9 \/\-_,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_,.].')
                  ],
                  ['field' => 'activity',
                   'label' => 'Activity',
                   'rules' => 'trim|required|max_length[500]|regex_match[/[a-zA-Z0-9 ()@\/\-_+,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 ()@\/\-_+,.].')
                  ],
                  ['field' => 'action',
                   'label' => 'Tindakan',
                   'rules' => 'trim|max_length[500]|regex_match[/[a-zA-Z0-9 ()@\/\-_+,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 ()@\/\-_+,.].')
                  ],
                  ['field' => 'problem',
                   'label' => 'Indication/Problem',
                   'rules' => 'trim|max_length[500]|regex_match[/[a-zA-Z0-9 ()@\/\-_+,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 ()@\/\-_+,.].')
                  ],
                  ['field' => 'result_activity',
                   'label' => 'Activity Result',
                   'rules' => 'trim|required|regex_match[/[a-zA-Z0-9 ()@\/\-_+,.]+$/]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 ()@\/\-_+,.].')
                  ],
                  ['field' => 'status',
                   'label' => 'Status',
                   'rules' => 'required|regex_match[/(finished|pending|on-progress)$/]',
                   'errors'=> array('regex_match' => '{field} value must finished/pending/on-progress')
                  ]
            ];

        return $form_rules;
	}

      public function profile_validation()
      {
            $form_rules = [
                  ['field' => 'user_name',
                   'label' => 'Username',
                   'rules' => 'required|regex_match[/[a-z0-9_]+$/]|min_length[3]|max_length[50]',
                   'errors'=> array('regex_match' => 'Allowed character for {field} are [a-z0-9_]',
                              'min_length' => 'Minimum character for {field} is {param} character',
                              'max_length' => 'Maximum character for {field} is {param} character')
                  ],
                  ['field' => 'employee_place_ob',
                   'label' => 'Place of Birth',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 \-]+$/]',
                   'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 \-]')
                  ],
                  ['field' => 'employee_date_ob',
                   'label' => 'Date of Birth',
                   'rules' => 'required|regex_date',
                   'errors'=> array('regex_date' => '{field} format must YYYY-MM-DD')
                  ],
                  ['field' => 'employee_address',
                   'label' => 'Employee Address',
                   'rules' => 'required|max_length[350]|regex_match[/[a-zA-Z0-9 (\-_,)@\/]+$/]',
                   'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 (\-_,)@\/]')
                  ],
                  ['field' => 'employee_bio',
                   'label' => 'Employee Bio',
                   'rules' => 'regex_match[/[a-zA-Z0-9 (\-_.)@&]+$/]|max_length[350]',
                   'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 (\-_.)@&].')
                  ],
                  ['field' => 'employee_phone',
                   'label' => 'Phone',
                   'rules' => 'required|phone_regex',
                   'errors'=> array('phone_regex' => '{field} must be a valid Indonesian Phone Number.')
                  ],
                  ['field' => 'user_email',
                   'label' => 'User Email',
                   'rules' => 'required|valid_email',
                   'errors'=> array('valid_email' => '{field} must be a valid Email Address.')
                  ],
                  ['field' => 'facebook',
                   'label' => 'Facebook URL',
                   'rules' => 'valid_url',
                   'errors'=> array('valid_url' => '{field} must be a valid URL.')
                  ],
                  ['field' => 'instagram',
                   'label' => 'Instagram URL',
                   'rules' => 'valid_url',
                   'errors'=> array('valid_url' => '{field} must be a valid URL.')
                  ],
                  ['field' => 'website',
                   'label' => 'Website URL',
                   'rules' => 'valid_url',
                   'errors'=> array('valid_url' => '{field} must be a valid URL.')
                  ]
            ];

            return $form_rules;
      }

      public function addEbook_validation()
      {
            $form_rules = [
                  ['field' => 'category[]',
                   'label' => 'Ebook Category',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 \-_]+$/]',
                   'errors'=> array('regex_match' => 'Allowed Character for {field} are [a-zA-Z0-9 \-_].')
                  ],
                  ['field' => 'ebook_title',
                   'label' => 'Ebook Title',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 \-_]+$/]|min_length[3]|max_length[50]',
                   'errors'=> array('regex_match' => 'Allowed Character for {field} are [a-zA-Z0-9 \-_].')
                  ],
                  ['field' => 'ebook_description',
                   'label' => 'Ebook Description',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 (\-_.)\/&]+$/]|min_length[3]|max_length[255]',
                   'errors'=> array('required' => '{field} masih kosong, silakan isi',
                              'min_length' => '{field} tidak boleh kurang dari {param} karakter',
                              'max_length' => '{field} tidak boleh lebih dari {param} karakter')
                  ]
            ];

            return $form_rules;
      }

      public function editEbook_validation()
      {
            $form_rules = [
                  ['field' => 'upload_date',
                   'label' => 'Upload Date',
                   'rules' => 'required|regex_date'
                  ],
                  ['field' => 'category[]',
                   'label' => 'Ebook Category',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 \-_]+$/]',
                   'errors'=> array('regex_match' => 'Allowed Character for {field} are [a-zA-Z0-9 \-_].')
                  ],
                  ['field' => 'ebook_title',
                   'label' => 'Ebook Title',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 \-_]+$/]|min_length[3]|max_length[50]',
                   'errors'=> array('regex_match' => 'Allowed Character for {field} are [a-zA-Z0-9 \-_].')
                  ],
                  ['field' => 'ebook_description',
                   'label' => 'Ebook Description',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 (\-_.)\/&]+$/]|min_length[3]|max_length[255]',
                   'errors'=> array('required' => '{field} masih kosong, silakan isi',
                              'min_length' => '{field} tidak boleh kurang dari {param} karakter',
                              'max_length' => '{field} tidak boleh lebih dari {param} karakter')
                  ],
                  ['field' => 'oldbook',
                   'label' => 'Old Ebook',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9\-_.]+$/]'
                  ]
            ];

            return $form_rules;
      }

      public function employee_validation()
      {
        $form_rules = [
            ['field' => 'employee_name',
             'label' => 'Employee Name',
             'rules' => 'trim|required|regex_match[/[a-zA-Z0-9 ,.\']+$/]|min_length[2]|max_length[100]',
             'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 ,.\'].')
            ],
            ['field' => 'jobdesc_id',
             'label' => 'Jobdesc Name',
             'rules' => 'required|integer'
            ],
            ['field' => 'user_name',
             'label' => 'Username',
             'rules' => 'required|regex_match[/[a-z0-9_]+$/]|min_length[3]|max_length[50]',
             'errors'=> array('regex_match' => 'Allowed character for {field} are [a-z0-9_]',
                        'min_length' => 'Minimum character for {field} is {param} character',
                        'max_length' => 'Maximum character for {field} is {param} character')
            ],
            ['field' => 'employee_place_ob',
             'label' => 'Place of Birth',
             'rules' => 'required|regex_match[/[a-zA-Z0-9 \-]+$/]',
             'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 \-]')
            ],
            ['field' => 'employee_date_ob',
             'label' => 'Date of Birth',
             'rules' => 'required|regex_date',
             'errors'=> array('regex_date' => '{field} format must YYYY-MM-DD')
            ],
            ['field' => 'employee_address',
             'label' => 'Employee Address',
             'rules' => 'required|max_length[350]|regex_match[/[a-zA-Z0-9 (\-_,)@\/]+$/]',
             'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 (\-_,)@\/]')
            ],
            ['field' => 'employee_bio',
             'label' => 'Employee Bio',
             'rules' => 'regex_match[/[a-zA-Z0-9 (\-_.)@&]+$/]|max_length[350]',
             'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 (\-_.)@&].')
            ],
            ['field' => 'employee_phone',
             'label' => 'Phone',
             'rules' => 'required|phone_regex',
             'errors'=> array('phone_regex' => '{field} must be a valid Indonesian Phone Number.')
            ],
            ['field' => 'user_email',
             'label' => 'User Email',
             'rules' => 'required|valid_email',
             'errors'=> array('valid_email' => '{field} must be a valid Email Address.')
            ],
            ['field' => 'facebook',
             'label' => 'Facebook URL',
             'rules' => 'valid_url',
             'errors'=> array('valid_url' => '{field} must be a valid URL.')
            ],
            ['field' => 'instagram',
             'label' => 'Instagram URL',
             'rules' => 'valid_url',
             'errors'=> array('valid_url' => '{field} must be a valid URL.')
            ],
            ['field' => 'website',
             'label' => 'Website URL',
             'rules' => 'valid_url',
             'errors'=> array('valid_url' => '{field} must be a valid URL.')
            ]
        ];

        return $form_rules;
    }

      public function editEmployee_validation()
      {
            $form_rules = [
                  ['field' => 'employee_name',
                   'label' => 'Employee Name',
                   'rules' => 'trim|required|regex_match[/[a-zA-Z0-9 ,.\']+$/]|min_length[2]|max_length[100]',
                   'errors'=> array('regex_match' => 'Allowed character for {field} are [a-zA-Z0-9 ,.\'].')
                  ],
                  ['field' => 'jobdesc_id',
                   'label' => 'Jobdesc Name',
                   'rules' => 'required|integer'
                  ],
                  ['field' => 'jobdesc_series',
                   'label' => 'Jobdesc Series',
                   'rules' => 'required|is_natural_no_zero'
                  ],
                  ['field' => 'user_email',
                   'label' => 'User Email',
                   'rules' => 'required|valid_email',
                   'errors'=> array('valid_email' => '{field} must be a valid Email Address.')
                  ]
            ];

            return $form_rules;
      }

      public function appSetting_validation()
      {
            $form_rules = [
                  ['field' => 'app_title',
                   'label' => 'Main App Title',
                   'rules' => 'required|alpha_numeric_spaces|max_length[50]'
                  ],
                  ['field' => 'app_title_alt',
                   'label' => 'App Title (alt)',
                   'rules' => 'required|alpha_numeric_spaces|max_length[20]'
                  ],
                  ['field' => 'footer_text',
                   'label' => 'App Footer Text',
                   'rules' => 'required|max_length[150]'
                  ],
                  ['field' => 'show_month',
                   'label' => 'Total Month to Display in Employee Graphic',
                   'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[2]'
                  ],
                  ['field' => 'category_activity_id[]',
                   'label' => 'Activity Categories to Displayed in Employee Graph',
                   'rules' => 'required|is_natural_no_zero',
                  ]
            ];

            return $form_rules;
      }

      public function ticket_validation()
      {
            $form_rules = [
                  ['field' => 'reporter',
                   'label' => 'Reporter Name',
                   'rules' => 'required|alpha_numeric_spaces|max_length[100]'
                  ],
                  ['field' => 'problem_report',
                   'label' => 'Problem  Report',
                   'rules' => 'required|regex_match[/[a-zA-Z0-9 &(\-_,).]+$/]|max_length[255]',
                   'errors'=> array('regex_match' => 'Allowed Character for {field} are [a-zA-Z0-9 &()-_,.].')
                  ],
                  ['field' => 'date_report',
                   'label' => 'Date Report',
                   'rules' => 'required|regex_date',
                   'errors'=> array('regex_date' => '{field} must in YYYY-MM-DD format.')
                  ],
                  ['field' => 'location',
                   'label' => 'Location',
                   'rules' => 'trim|required|regex_match[/[a-zA-Z0-9 \/\-_+,]+$/]|max_length[80]',
                   'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_+,].')
                  ],
                  ['field' => 'category_activity_id',
                   'label' => 'Category Activity',
                   'rules' => 'required|is_natural_no_zero',
                   'errors'=> array('is_natural_no_zero' => '{field} must integer.')
                  ]
            ];

            return $form_rules;
      }
}