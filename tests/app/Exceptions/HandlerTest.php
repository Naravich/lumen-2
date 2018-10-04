<?php
namespace Tests\App\Exceptions;
use TestCase;
use \Mockery as m;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HandlerTest extends TestCase
{
    /** @test **/
    public function it_responds_with_html_when_json_is_not_accepted() {
        $subject = m::mock(Handler::class)->makePartial();
        $subject->shouldNotReceive('isDebugMode');

        $request = m::mock(Request::class);
        $request->shouldReceive('wantsJson')->andReturn(false);

        $exception = m::mock(\Exception::class, ['Error!']);
        $exception->shouldNotReceive('getStatusCode');
        $exception->shouldNotReceive('getTrace');
        $exception->shouldNotReceive('getMessage');

        // Call the method under test, this is not a mocked method.
        $result = $subject->render($request, $exception);

        // Assert that `render` does not return a JsonResponse
        $this->assertNotInstanceOf(JsonResponse::class, $result);
    }

    /** @test **/
    public function it_responds_with_json_for_json_consumers()
    {
        $subject = m::mock(Handler::class)->makePartial();
        $subject
            ->shouldReceive('isDebugMode')
            ->andReturn(false);

        $request = m::mock(Request::class);
        $request
            ->shouldReceive('wantsJson')
            ->andReturn(true);
        $exception = m::mock(\Exception::class, ['Doh!']);
        $exception->shouldReceive('getMessage')
            ->andReturn('Doh!');

        /** @var JsonResponse $result */
        $result = $subject->render($request, $exception);
        $data = $result->getData();

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertObjectHasAttribute('error', $data);
        $this->assertAttributeEquals('Doh!', 'message', $data->error);
        $this->assertAttributeEquals(400, 'status', $data->error);
    }
}