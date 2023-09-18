<?php

namespace App;

use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployementDetails;
use App\Models\Experience;
use App\Models\ProfessionalQualification;
use App\Models\Promotion;
use App\Models\Qualification;
use App\Models\ResultHistory;
use App\Models\TeachingDetail;
use App\Models\Training;
use App\Models\Transfer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, LogsActivity;


    public static function country()
    {
        return [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Antigua & Deps',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Cape Verde',
            'Central African Rep',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo',
            'Congo {Democratic Rep}',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'East Timor',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland {Republic}',
            'Israel',
            'Italy',
            'Ivory Coast',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Korea North',
            'Korea South',
            'Kosovo',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Macedonia',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar, {Burma}',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russian Federation',
            'Rwanda',
            'St Kitts & Nevis',
            'St Lucia',
            'Saint Vincent & the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome & Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Swaziland',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Tonga',
            'Trinidad & Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Vatican City',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe',
        ];
    }

    public static function districts()
    {
        return $districts = [
            'AJK' =>
                ['Muzaffarabad',
                    'Jhelum Valley',
                    'Neelum',
                    'Mirpur',
                    'Bhimber',
                    'Kotli',
                    'Poonch',
                    'Bagh',
                    'Haveli',
                    'Sudhnati',
                    'Refugee Jammu & Kashmir',
                ],
            'Balochistan' =>
                ['Awaran',
                    'Barkhan',
                    'Chagai',
                    'Dera Bugti',
                    'Gwadar',
                    'Harnai',
                    'Jafarabad',
                    'Jhal Magsi',
                    'Kachhi',
                    'Kalat',
                    'Kech',
                    'Kharan',
                    'Khuzdar',
                    'Killa Abdullah',
                    'Killa Saifullah',
                    'Kohlu',
                    'Lasbela',
                    'Lehri',
                    'Loralai',
                    'Mastung',
                    'Musakhel',
                    'Nasirabad',
                    'Nushki[18]',
                    'Panjgur',
                    'Pishin',
                    'Quetta',
                    'Sherani',
                    'Sibi',
                    'Sohbatpur',
                    'Washuk',
                    'Zhob',
                    'Ziarat',
                    'Duki',
                ],
            'Gilgit Baltistan' =>
                ['Ghanche',
                    'Skardu',
                    'Astore',
                    'Diamer',
                    'Ghizer',
                    'Gilgit',
                    'Hunza',
                    'Kharmang',
                    'Shigar',
                    'Nagar',
                    'Gupis–Yasin',
                    'Tangir',
                    'Darel',
                    'Roundu',
                ],
            'KPK' =>
                ['Abbottabad',
                    'Bajaur',
                    'Bannu',
                    'Battagram',
                    'Buner',
                    'Charsadda',
                    'Chitral',
                    'Dera Ismail Khan',
                    'Hangu',
                    'Haripur',
                    'Karak',
                    'Khyber',
                    'Kohat',
                    'Kurram',
                    'Lakki Marwat',
                    'Lower Dir',
                    'Lower Kohistan',
                    'Malakand',
                    'Mansehra',
                    'Mardan',
                    'Mohmand',
                    'North Waziristan',
                    'Nowshera',
                    'Orakzai',
                    'Peshawar',
                    'Shangla',
                    'South Waziristan',
                    'Swabi',
                    'Swat',
                    'Tank',
                    'Torghar',
                    'Upper Dir',
                    'Upper Kohistan',
                ],
            'Punjab' =>
                ['Attock',
                    'Bahawalnagar',
                    'Bahawalpur',
                    'Bhakkar',
                    'Chakwal',
                    'Chiniot',
                    'Dera Ghazi Khan',
                    'Faisalabad',
                    'Gujranwala',
                    'Gujrat',
                    'Hafizabad',
                    'Jhang',
                    'Jhelum',
                    'Kasur',
                    'Khanewal',
                    'Khushab',
                    'Lahore',
                    'Layyah',
                    'Lodhran',
                    'Mandi Bahauddin',
                    'Mianwali',
                    'Multan',
                    'Muzaffargarh',
                    'Narowal',
                    'Nankana Sahib[5]',
                    'Okara',
                    'Pakpattan',
                    'Rahim Yar Khan',
                    'Rajanpur',
                    'Rawalpindi',
                    'Sahiwal',
                    'Sargodha',
                    'Sheikhupura',
                    'Sialkot',
                    'Toba Tek Singh',
                    'Vehari',
                ],
            'Sindh' =>
                ['Badin',
                    'Dadu',
                    'Ghotki',
                    'Hyderabad',
                    'Jacobabad',
                    'Jamshoro',
                    'Karachi Central',
                    'Karachi East',
                    'Karachi South',
                    'Karachi West',
                    'Kashmore',
                    'Khairpur',
                    'Korangi',
                    'Larkana',
                    'Malir',
                    'Matiari',
                    'Mirpur Khas',
                    'Naushahro Feroze',
                    'Qambar Shahdadkot',
                    'Sanghar',
                    'Shaheed Benazir Abad',
                    'Shikarpur',
                    'Sujawal',
                    'Sukkur',
                    'Tando Allahyar',
                    'Tando Muhammad Khan',
                    'Tharparkar',
                    'Thatta',
                    'Umerkot'],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */

//    protected $fillable = [
//        'email', 'password', 'dep_id', 'sub_dep_id',
//        'cnic', 'first_name', 'middle_name', 'last_name', 'father_first_name', 'father_middle_name',
//        'father_last_name', 'gender', 'marital_status', 'refugee_status', 'birth_place', 'birth_date',
//        'province_domicile', 'district_domicile', 'current_address', 'permanent_address', 'image',
//        'active', 'residential_phone', 'office_phone', 'mobile_phone', 'fax_number', 'emis_code',
//        'usertype', 'verified', 'emp_type', 'designation', 'personal_no', 'verified_by', 'blood_group', 'passport_no', 'next_of_kin', 'relationship',
//        'whatsapp_number', 'type_of_service', 'ntn_no', 'gpf_no', 'time_scale', 'belt_no','scale','payroll_area'
//    ];
    protected $fillable = [
        'dep_id','sub_dep_id','cnic','personal_no','first_name','middle_name','last_name','father_first_name',
        'father_middle_name','father_last_name','gender','marital_status','refugee_status','blood_group','birth_place',
        'birth_date','province_domicile','district_domicile','current_address','permanent_address','image','active',
        'residential_phone','office_phone','mobile_phone','whatsapp_number','fax_number','emis_code','usertype','email',
        'emp_type','type_of_service','designation','passport_no','ntn_no','gpf_no','ddo_code','cost_center',
        'payroll_area','position','fund','department','belt_no','employment_quota','next_of_kin','relationship',
        'qualification_hed','is_gazetted','appointment_date','initially_appointed','institute_name',
        'account_office_number','subject','scale','time_scale','time_scale_hed','date_time_scale_hed',
        'state_refugee_status_hed','blod_group_hed','birth_date_hed','birth_place_hed','basic_salary_hed',
        'bps_hed','province','district','tehsil','present_lat_health','present_lng_health','permanent province_health',
        'permanent_distrct_health','permanent_tehsil_health','nationality_health','email_health','worker_status_health',
        'is_frontline_health','facility_type_health','religion','uc','permanent_uc_health','hospital_province_health',
        'hospital_district_health','facility_name_health','nadara_verified_cnic','verified','email_verified_at',
        'password','remember_token','verified_by',
    ];

    protected static $logAttributes = ['*'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->hasOne(Department::class,'id','dep_id');
    }

    public function dep()
    {
        return $this->hasOne(Department::class,'id','dep_id');
    }

    public function EmployementDetails()
    {
        return $this->hasMany(EmployementDetails::class, 'employee_id');
    }

    public function user_designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation');
    }


    public function qualification()
    {
        return $this->hasMany(Qualification::class, 'employee_id');
    }

    //relation with professional qualification
    public function professional_qualification()
    {
        return $this->hasMany(ProfessionalQualification::class, 'employee_id');
    }

    //relation with experiences
    public function experience()
    {
        return $this->hasMany(Experience::class, 'employee_id');
    }

    //relation with trainings
    public function trainings()
    {
        return $this->hasMany(Training::class, 'employee_id');
    }

    //relation with transfers
    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'employee_id');
    }

    //relation with teaching details
    public function teaching_details()
    {
        return $this->hasMany(TeachingDetail::class, 'employee_id');
    }

    //relation with teaching details
    public function result_history()
    {
        return $this->hasMany(ResultHistory::class, 'employee_id');
    }

    //relation with promotion
    public function promotion()
    {
        return $this->hasMany(Promotion::class, 'employee_id');
    }

    public static function hasAccess($employee)
    {
        if (Auth::user()->usertype == 'user' && Auth::user()->id != $employee->id) {
            return false;
        } elseif (Auth()->user()->usertype == "department_admin" && Auth::user()->dep_id != $employee->dep_id) {
            return false;
        }
        return true;
    }

    public static function bloodGroup(): array
    {
        $blood_group = ['O−', 'O+', 'A−', 'A+', 'B−', 'B+', 'AB−', 'AB+'];
        sort($blood_group);
        return $blood_group;
    }

    public static function typeOfService(): array
    {
        $typeOfService = [
            'Judicial',
            'HC Estab',
            'Judicial Dep (LC)',
            'Qazi Branch',
            'Other (Not Related)',
        ];
        return $typeOfService;
    }


    public static function training_type(): array
    {
        $training_type = [
            'Certificate',
            'Diploma',
            'Distant Learning',
            'Online',
            'CCNA',
            'CCNP',
        ];
        return $training_type;
    }

    public static function degree_list()
    {
        $degree = [
            "GENERAL AGRICULTURE" => "Agriculture & Natural Resources",
            "AGRICULTURE PRODUCTION AND MANAGEMENT" => "Agriculture & Natural Resources",
            "AGRICULTURAL ECONOMICS" => "Agriculture & Natural Resources",
            "ANIMAL SCIENCES" => "Agriculture & Natural Resources",
            "FOOD SCIENCE" => "Agriculture & Natural Resources",
            "PLANT SCIENCE AND AGRONOMY" => "Agriculture & Natural Resources",
            "SOIL SCIENCE" => "Agriculture & Natural Resources",
            "MISCELLANEOUS AGRICULTURE" => "Agriculture & Natural Resources",
            "FORESTRY" => "Agriculture & Natural Resources",
            "NATURAL RESOURCES MANAGEMENT" => "Agriculture & Natural Resources",
            "FINE ARTS" => "Arts",
            "DRAMA AND THEATER ARTS" => "Arts",
            "MUSIC" => "Arts",
            "VISUAL AND PERFORMING ARTS" => "Arts",
            "COMMERCIAL ART AND GRAPHIC DESIGN" => "Arts",
            "FILM VIDEO AND PHOTOGRAPHIC ARTS" => "Arts",
            "STUDIO ARTS" => "Arts",
            "MISCELLANEOUS FINE ARTS" => "Arts",
            "ENVIRONMENTAL SCIENCE" => "Biology & Life Science",
            "BIOLOGY" => "Biology & Life Science",
            "BIOCHEMICAL SCIENCES" => "Biology & Life Science",
            "BOTANY" => "Biology & Life Science",
            "MOLECULAR BIOLOGY" => "Biology & Life Science",
            "ECOLOGY" => "Biology & Life Science",
            "GENETICS" => "Biology & Life Science",
            "MICROBIOLOGY" => "Biology & Life Science",
            "PHARMACOLOGY" => "Biology & Life Science",
            "PHYSIOLOGY" => "Biology & Life Science",
            "ZOOLOGY" => "Biology & Life Science",
            "NEUROSCIENCE" => "Biology & Life Science",
            "MISCELLANEOUS BIOLOGY" => "Biology & Life Science",
            "COGNITIVE SCIENCE AND BIOPSYCHOLOGY" => "Biology & Life Science",
            "GENERAL BUSINESS" => "Business",
            "ACCOUNTING" => "Business",
            "ACTUARIAL SCIENCE" => "Business",
            "BUSINESS MANAGEMENT AND ADMINISTRATION" => "Business",
            "OPERATIONS LOGISTICS AND E-COMMERCE" => "Business",
            "BUSINESS ECONOMICS" => "Business",
            "MARKETING AND MARKETING RESEARCH" => "Business",
            "FINANCE" => "Business",
            "HUMAN RESOURCES AND PERSONNEL MANAGEMENT" => "Business",
            "INTERNATIONAL BUSINESS" => "Business",
            "HOSPITALITY MANAGEMENT" => "Business",
            "MANAGEMENT INFORMATION SYSTEMS AND STATISTICS" => "Business",
            "MISCELLANEOUS BUSINESS & MEDICAL ADMINISTRATION" => "Business",
            "COMMUNICATIONS" => "Communications & Journalism",
            "JOURNALISM" => "Communications & Journalism",
            "MASS MEDIA" => "Communications & Journalism",
            "ADVERTISING AND PUBLIC RELATIONS" => "Communications & Journalism",
            "COMMUNICATION TECHNOLOGIES" => "Computers & Mathematics",
            "COMPUTER AND INFORMATION SYSTEMS" => "Computers & Mathematics",
            "COMPUTER PROGRAMMING AND DATA PROCESSING" => "Computers & Mathematics",
            "COMPUTER SCIENCE" => "Computers & Mathematics",
            "INFORMATION SCIENCES" => "Computers & Mathematics",
            "COMPUTER ADMINISTRATION MANAGEMENT AND SECURITY" => "Computers & Mathematics",
            "COMPUTER NETWORKING AND TELECOMMUNICATIONS" => "Computers & Mathematics",
            "MATHEMATICS" => "Computers & Mathematics",
            "APPLIED MATHEMATICS" => "Computers & Mathematics",
            "STATISTICS AND DECISION SCIENCE" => "Computers & Mathematics",
            "MATHEMATICS AND COMPUTER SCIENCE" => "Computers & Mathematics",
            "GENERAL EDUCATION" => "Education",
            "EDUCATIONAL ADMINISTRATION AND SUPERVISION" => "Education",
            "SCHOOL STUDENT COUNSELING" => "Education",
            "ELEMENTARY EDUCATION" => "Education",
            "MATHEMATICS TEACHER EDUCATION" => "Education",
            "PHYSICAL AND HEALTH EDUCATION TEACHING" => "Education",
            "EARLY CHILDHOOD EDUCATION" => "Education",
            "SCIENCE AND COMPUTER TEACHER EDUCATION" => "Education",
            "SECONDARY TEACHER EDUCATION" => "Education",
            "SPECIAL NEEDS EDUCATION" => "Education",
            "SOCIAL SCIENCE OR HISTORY TEACHER EDUCATION" => "Education",
            "TEACHER EDUCATION: MULTIPLE LEVELS" => "Education",
            "LANGUAGE AND DRAMA EDUCATION" => "Education",
            "ART AND MUSIC EDUCATION" => "Education",
            "MISCELLANEOUS EDUCATION" => "Education",
            "LIBRARY SCIENCE" => "Education",
            "ARCHITECTURE" => "Engineering",
            "GENERAL ENGINEERING" => "Engineering",
            "AEROSPACE ENGINEERING" => "Engineering",
            "BIOLOGICAL ENGINEERING" => "Engineering",
            "ARCHITECTURAL ENGINEERING" => "Engineering",
            "BIOMEDICAL ENGINEERING" => "Engineering",
            "CHEMICAL ENGINEERING" => "Engineering",
            "CIVIL ENGINEERING" => "Engineering",
            "COMPUTER ENGINEERING" => "Engineering",
            "ELECTRICAL ENGINEERING" => "Engineering",
            "ENGINEERING MECHANICS PHYSICS AND SCIENCE" => "Engineering",
            "ENVIRONMENTAL ENGINEERING" => "Engineering",
            "GEOLOGICAL AND GEOPHYSICAL ENGINEERING" => "Engineering",
            "INDUSTRIAL AND MANUFACTURING ENGINEERING" => "Engineering",
            "MATERIALS ENGINEERING AND MATERIALS SCIENCE" => "Engineering",
            "MECHANICAL ENGINEERING" => "Engineering",
            "METALLURGICAL ENGINEERING" => "Engineering",
            "MINING AND MINERAL ENGINEERING" => "Engineering",
            "NAVAL ARCHITECTURE AND MARINE ENGINEERING" => "Engineering",
            "NUCLEAR ENGINEERING" => "Engineering",
            "PETROLEUM ENGINEERING" => "Engineering",
            "MISCELLANEOUS ENGINEERING" => "Engineering",
            "ENGINEERING TECHNOLOGIES" => "Engineering",
            "ENGINEERING AND INDUSTRIAL MANAGEMENT" => "Engineering",
            "ELECTRICAL ENGINEERING TECHNOLOGY" => "Engineering",
            "INDUSTRIAL PRODUCTION TECHNOLOGIES" => "Engineering",
            "MECHANICAL ENGINEERING RELATED TECHNOLOGIES" => "Engineering",
            "MISCELLANEOUS ENGINEERING TECHNOLOGIES" => "Engineering",
            "MATERIALS SCIENCE" => "Engineering",
            "NUTRITION SCIENCES" => "Health",
            "GENERAL MEDICAL AND HEALTH SERVICES" => "Health",
            "COMMUNICATION DISORDERS SCIENCES AND SERVICES" => "Health",
            "HEALTH AND MEDICAL ADMINISTRATIVE SERVICES" => "Health",
            "MEDICAL ASSISTING SERVICES" => "Health",
            "MEDICAL TECHNOLOGIES TECHNICIANS" => "Health",
            "HEALTH AND MEDICAL PREPARATORY PROGRAMS" => "Health",
            "NURSING" => "Health",
            "PHARMACY PHARMACEUTICAL SCIENCES AND ADMINISTRATION" => "Health",
            "TREATMENT THERAPY PROFESSIONS" => "Health",
            "COMMUNITY AND PUBLIC HEALTH" => "Health",
            "MISCELLANEOUS HEALTH MEDICAL PROFESSIONS" => "Health",
            "AREA ETHNIC AND CIVILIZATION STUDIES" => "Humanities & Liberal Arts",
            "LINGUISTICS AND COMPARATIVE LANGUAGE AND LITERATURE" => "Humanities & Liberal Arts",
            "FRENCH GERMAN LATIN AND OTHER COMMON FOREIGN LANGUAGE STUDIES" => "Humanities & Liberal Arts",
            "OTHER FOREIGN LANGUAGES" => "Humanities & Liberal Arts",
            "ENGLISH LANGUAGE AND LITERATURE" => "Humanities & Liberal Arts",
            "COMPOSITION AND RHETORIC" => "Humanities & Liberal Arts",
            "LIBERAL ARTS" => "Humanities & Liberal Arts",
            "HUMANITIES" => "Humanities & Liberal Arts",
            "INTERCULTURAL AND INTERNATIONAL STUDIES" => "Humanities & Liberal Arts",
            "PHILOSOPHY AND RELIGIOUS STUDIES" => "Humanities & Liberal Arts",
            "THEOLOGY AND RELIGIOUS VOCATIONS" => "Humanities & Liberal Arts",
            "ANTHROPOLOGY AND ARCHEOLOGY" => "Humanities & Liberal Arts",
            "ART HISTORY AND CRITICISM" => "Humanities & Liberal Arts",
            "HISTORY" => "Humanities & Liberal Arts",
            "UNITED STATES HISTORY" => "Humanities & Liberal Arts",
            "COSMETOLOGY SERVICES AND CULINARY ARTS" => "Industrial Arts & Consumer Services",
            "FAMILY AND CONSUMER SCIENCES" => "Industrial Arts & Consumer Services",
            "MILITARY TECHNOLOGIES" => "Industrial Arts & Consumer Services",
            "PHYSICAL FITNESS PARKS RECREATION AND LEISURE" => "Industrial Arts & Consumer Services",
            "CONSTRUCTION SERVICES" => "Industrial Arts & Consumer Services",
            "ELECTRICAL, MECHANICAL, AND PRECISION TECHNOLOGIES AND PRODUCTION" => "Industrial Arts & Consumer Services",
            "TRANSPORTATION SCIENCES AND TECHNOLOGIES" => "Industrial Arts & Consumer Services",
            "MULTI/INTERDISCIPLINARY STUDIES" => "Interdisciplinary",
            "COURT REPORTING" => "Law & Public Policy",
            "PRE-LAW AND LEGAL STUDIES" => "Law & Public Policy",
            "CRIMINAL JUSTICE AND FIRE PROTECTION" => "Law & Public Policy",
            "PUBLIC ADMINISTRATION" => "Law & Public Policy",
            "PUBLIC POLICY" => "Law & Public Policy",
            "N/A (less than bachelor's degree)" => "NA",
            "PHYSICAL SCIENCES" => "Physical Sciences",
            "ASTRONOMY AND ASTROPHYSICS" => "Physical Sciences",
            "ATMOSPHERIC SCIENCES AND METEOROLOGY" => "Physical Sciences",
            "CHEMISTRY" => "Physical Sciences",
            "GEOLOGY AND EARTH SCIENCE" => "Physical Sciences",
            "GEOSCIENCES" => "Physical Sciences",
            "OCEANOGRAPHY" => "Physical Sciences",
            "PHYSICS" => "Physical Sciences",
            "MULTI-DISCIPLINARY OR GENERAL SCIENCE" => "Physical Sciences",
            "NUCLEAR, INDUSTRIAL RADIOLOGY, AND BIOLOGICAL TECHNOLOGIES" => "Physical Sciences",
            "PSYCHOLOGY" => "Psychology & Social Work",
            "EDUCATIONAL PSYCHOLOGY" => "Psychology & Social Work",
            "CLINICAL PSYCHOLOGY" => "Psychology & Social Work",
            "COUNSELING PSYCHOLOGY" => "Psychology & Social Work",
            "INDUSTRIAL AND ORGANIZATIONAL PSYCHOLOGY" => "Psychology & Social Work",
            "SOCIAL PSYCHOLOGY" => "Psychology & Social Work",
            "MISCELLANEOUS PSYCHOLOGY" => "Psychology & Social Work",
            "HUMAN SERVICES AND COMMUNITY ORGANIZATION" => "Psychology & Social Work",
            "SOCIAL WORK" => "Psychology & Social Work",
            "INTERDISCIPLINARY SOCIAL SCIENCES" => "Social Science",
            "GENERAL SOCIAL SCIENCES" => "Social Science",
            "ECONOMICS" => "Social Science",
            "CRIMINOLOGY" => "Social Science",
            "GEOGRAPHY" => "Social Science",
            "INTERNATIONAL RELATIONS" => "Social Science",
            "POLITICAL SCIENCE AND GOVERNMENT" => "Social Science",
            "SOCIOLOGY" => "Social Science",
            "MISCELLANEOUS SOCIAL SCIENCES" => "Social Science",
            "Matric Science" => "Matric Science",
            "Matric Arts" => "Matric Arts",
            "O Level" => "O Level",
            "FA" => "FA",
            "FSc Pre-M" => "FSc Pre-M",
            "FSc Pre-Engg" => "FSc Pre-Engg",
            "A-Level" => "A-Level",
            "BA Arts" => "BA Arts",
            "MA" => "MA",
            "MBA" => "MBA",
            "BA" => "BA",
            "BCS" => "BCS",
            "BSC" => "BSC",
            "MBBS" => "MBBS",
            "BE" => "BE",
            "M.Phil" => "M.Phil",
            "MSCS" => "MSCS",
            "PHD" => "PHD",
        ];

        ksort($degree);
        return $degree;
    }


    public static function get_sub_designation($dep_id, $parent_id = 0, $indent = '', $user_designation)
    {
        $des_tree = '';

        $parent_designations = Designation::where('parent_id', $parent_id)->where('dep_id', $dep_id)->orderBy('designation_name', 'asc')->get();
        if ($parent_designations->isNotEmpty()) {
            foreach ($parent_designations as $des) {
                //$des->id == auth()->user()->designation
                $select = false;
                $attribute = null;
                if ($user_designation == $des->id) {
                    $select = true;
                    $attribute = 'selected';
                }
                $des_tree = $des_tree . '<option value="' . $des->id . '"  ' . $attribute . ' >' . $indent . $des->designation_name . '</option>';

                $des_tree = $des_tree . User::get_sub_designation($dep_id, $des->id, $indent . '&nbsp;&nbsp;&nbsp;', $user_designation);
            }
        }
        return $des_tree;

    }

    public static function getDesignationByDepartment($dep_id, $user_designation)
    {
        $parent_designations = '<option>No Designation Found</option>';
        if ($dep_id && $dep_id > 0) {
            $parent_designations = User::get_sub_designation($dep_id, 0, '', $user_designation);
        }
        return $parent_designations;
    }

}
