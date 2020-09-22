<?php

namespace Tests\Unit\App\Http\Requests;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var \App\Http\Requests\ContactRequest */
    private $rules;

    /** @var \Illuminate\Validation\Validator */
    private $validator;

    /** @var Contact */
    protected $contact;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rules = (new ContactRequest())->rules();
        $this->validator = app()->get('validator');
        $this->contact = \App\Models\Contact::factory()->make();
    }

    public function validationProvider()
    {
        /* Em um job real usaria o faker para gerar os casos */
        /* $faker = Factory::create(Factory::DEFAULT_LOCALE); */

        return [

            'all_data_is_required' => [
                'passed' => true,
                'data' => [
                    'name' => 'Fulano',
                    'email' => 'fulano@mail.com',
                    'phone' => '(11)1324-5678',
                    'message' => 'Small changes eventually add up to huge results.',
                    'attachment' => UploadedFile::fake()->create('trabalho.pdf', 480)
                ]
            ],

            'without_name' => [
                'passed' => false,
                'data' => [
                    //'name' => null,
                    'email' => 'fulano@mail.com',
                    'phone' => '(11)1324-5678',
                    'message' => 'When life throws you a rainy day, play in the puddles ~Pooh Bear.',
                    'attachment' => UploadedFile::fake()->create('guia.docx', 80)
                ]
            ],

            'very_small_name' => [
                'passed' => false,
                'data' => [
                    'name' => 'JP',
                    'email' => 'fulano@mail.com',
                    'phone' => '(11)91324-5678',
                    'message' => 'As soon as I saw you, I knew a grand adventure was about to happen ~Pooh',
                    'attachment' => UploadedFile::fake()->create('codigosdomortalkombat.txt', 333)
                ]
            ],

            'name_has_more_than_45_characters' => [
                'passed' => false,
                'data' => [
                    'name' => 'Alone wen can do so little; Together we can do so much ~Helen Keller',
                    'email' => 'fulano@mail.com',
                    'phone' => '(11)1324-5678',
                    'message' => 'Keep Looking up that\'s the secret of life...',
                    'attachment' => UploadedFile::fake()->create('passwords.doc', 333)
                ]
            ],

            'without_email' => [
                'passed' => false,
                'data' => [
                    'name' => 'Bruna',
                    //'email' => null,
                    'phone' => '(11)91324-5678',
                    'message' => 'Tact is the art of making a point without making an enemy ~Newton',
                    'attachment' => UploadedFile::fake()->create('playlist.txt', 333)
                ]
            ],

            'email_invalid' => [
                'passed' => false,
                'data' => [
                    'name' => 'Bia',
                    'email' => 'bia@a.b',
                    'phone' => '(11)91324-5678',
                    'message' => 'You\'re not a mess, you\'re brave for trying.',
                    'attachment' => UploadedFile::fake()->create('configuração.pdf', 333)
                ]
            ],

            'email_invalid_2' => [
                'passed' => false,
                'data' => [
                    'name' => 'Airton Senna',
                    'email' => 'bia@abc',
                    'phone' => '(11)91324-5678',
                    'message' => 'We\'ll love just the way you are if you\'re perfect. ~Moressette',
                    'attachment' => UploadedFile::fake()->create('agenda.odt', 333)
                ]
            ],

            'without_phone' => [
                'passed' => false,
                'data' => [
                    'name' => 'Januário',
                    'email' => 'luiz@baiao.io',
                    //'phone' => '',
                    'message' => 'The greatest secrets are always hidden in the most unlikely places ~Roald Dahl',
                    'attachment' => UploadedFile::fake()->create('manual.txt', 333)
                ]
            ],

            'phone_invalid_1' => [
                'passed' => false,
                'data' => [
                    'name' => 'Leonardo',
                    'email' => 'davinci@icloud.com',
                    'phone' => '11913245678',
                    'message' => '...wearing new shoes for the first time.',
                    'attachment' => UploadedFile::fake()->create('legendas.txt', 333)
                ]
            ],

            'phone_invalid_2' => [
                'passed' => false,
                'data' => [
                    'name' => 'Donatello',
                    'email' => 'donatodiccolo@hotmail.it',
                    'phone' => '(11)913245678',
                    'message' => 'You must do the things you think you cannot do ~Eleanor Roosevelt',
                    'attachment' => UploadedFile::fake()->create('receita.docx', 333)
                ]
            ],

            'phone_invalid_3' => [
                'passed' => false,
                'data' => [
                    'name' => 'Michelangelo',
                    'email' => 'dilodovico@gmail.it',
                    'phone' => '(11) 9132.4678',
                    'message' => 'Be the reason someone believes in the goodness of people.',
                    'attachment' => UploadedFile::fake()->create('sempre juntos.doc', 333)
                ]
            ],

            'phone_invalid_4' => [
                'passed' => false,
                'data' => [
                    'name' => 'Rafael',
                    'email' => 'sanzio@atom.it',
                    'phone' => '00 91324-5678',
                    'message' => 'Courage is being yourself everyday in a world that tells you to be someone else.',
                    'attachment' => UploadedFile::fake()->create('relatorio.odc', 333)
                ]
            ],

            'without_message' => [
                'passed' => false,
                'data' => [
                    'name' => 'Huguinho',
                    'email' => 'hugo@disney.com',
                    'phone' => '(11)91234-5678',
                    //'message' => 'Be you!',
                    'attachment' => UploadedFile::fake()->create('decreto.txt', 333)
                ]
            ],

            'without_attachment' => [
                'passed' => false,
                'data' => [
                    'name' => 'Zezinho',
                    'email' => 'joze@disney.com',
                    'phone' => '(11)91234-5678',
                    'message' => 'Difficult roads often lead to beautiful destinations.',
                    //'attachment' => UploadedFile::fake()->image('gatinha.png')
                ]
            ],

            'invalid_type_attachment' => [
                'passed' => false,
                'data' => [
                    'name' => 'Luisinho',
                    'email' => 'luis@disney.com',
                    'phone' => '(11)91234-5678',
                    'message' => 'You always pass failure on the way to success ~Mickey Rooney.',
                    'attachment' => UploadedFile::fake()->image('gatinha.png')
                ]
            ],

            'invalid_type_attachment_2' => [
                'passed' => false,
                'data' => [
                    'name' => 'Azza',
                    'email' => 'beltrano@mail.net',
                    'phone' => '(11)91234-5678',
                    'message' => 'The only time you fail is when you fall down and stay down ~Stephen Richards.',
                    'attachment' => UploadedFile::fake()->image('index.js')
                ]
            ],

            'attachment_exceeds_upload_limit' => [
                'passed' => false,
                'data' => [
                    'name' => 'Jesus',
                    'email' => 'cristo@paraiso.ceu',
                    'phone' => '(11)91234-5678',
                    'message' => 'Não temas, eu venci o mundo!',
                    'attachment' => UploadedFile::fake()->create('goals.docx', 501)
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validation_results_as_expected(bool $shouldPass, array $mockedRequestData)
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData)
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }

}
