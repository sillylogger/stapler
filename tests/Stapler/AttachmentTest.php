<?php

use Illuminate\Support\Facades\App;

class AttachmentTest extends TestCase
{

    /**
     * makeMethodPublic method
     *
     * @param  string $name - The name of the method we're making public
     * @return callable
     */
    protected function makeMethodPublic($name)
    {
        $class = new ReflectionClass('Codesleeve\Stapler\Attachment');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    public function testReturnResourceReturnsAPath()
    {

        // $interpolator = App::make('Interpolator');
        // $attachment = App::make('Attachment', ['name' => "TestAttachment", 'options' => [], 'interpolator' => $interpolator]);
        // $attachment = $this->getMock('Codesleeve\Stapler\Attachment', [], ['testAttachment', [], $interpolator]);

        $attachment = $this->getMockBuilder('Codesleeve\Stapler\Attachment')
            ->disableOriginalConstructor()
            ->getMock();

        $attachment->expects($this->once())
            ->method('originalFileName')
            ->will($this->returnValue('not an empty string'));
 
        $method = $this->makeMethodPublic('queueAllForDeletion');
        $method->invokeArgs($attachment, []);


        $this->assertNull($attachment->file_name);
        $this->assertNull($attachment->file_size);
        $this->assertNull($attachment->content_type);
        $this->assertNull($attachment->updated_at);
    }

}

class DummyModel {
  public $test_created_at;
  public $test_updated_at;
  public $test_content_type;
  public $test_file_size;
  public $test_file_name;

  
}

