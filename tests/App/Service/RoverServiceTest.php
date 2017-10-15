<?php
namespace Tests\App\Service;

use App\Enum\DirectionsEnum;
use App\Model\Rover;
use App\Service\RoverService;
use PHPUnit\Framework\TestCase;

class RoverServiceTest extends TestCase
{
    protected $serviceMock;

    protected function setUp()
    {

    }

    protected function tearDown()
    {
        $this->roverMock = null;
        $this->serviceMock = null;
    }

    /**
     * @param string $data
     * @dataProvider testOutPutDataProvider
     */
    public function testPrintPosition(string $data)
    {
        $this->serviceMock = $this->getMockBuilder(RoverService::class)
                                  ->setMethods(['printPosition'])
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $this->serviceMock->expects($this->once())
            ->method('printPosition')
            ->will($this->
            returnValue($data));

        $result = $this->serviceMock->printPosition();
        $this->assertEquals($result, $data);
    }

    /**
     * @param array  $dataPosition
     * @param string $dataCommands
     * @param string $expect
     * @dataProvider testFuncRoverServiceDataProvider
     */
    public function testFuncRoverService(array $dataPosition, string $dataCommands , string $expect)
    {

        $rover = new Rover();
        $roverService = new RoverService($rover);

        $roverService->setPosition($dataPosition[0],$dataPosition[1], $dataPosition[2]);
        $roverService->getCommands($dataCommands);
        $result = $roverService->printPosition();
        $this->assertEquals($result, $expect);
    }

    /**
     * @return array
     */
    public function testFuncRoverServiceDataProvider(): ?array
    {
        return [
            'check 1' => [
                'dataPostion' => [1,2, DirectionsEnum::N],
                'dataCommands' => "LMLMLMLMM",
                'expect' => '1 3 N',
            ],

            'check 2' => [
                'dataPostion' => [3,3, DirectionsEnum::E],
                'dataCommands' => "MMRMMRMRRM",
                'expect' => '5 1 E',
            ],
        ];
    }

    /**
     * @return array
     */
    public function testOutPutDataProvider(): array
    {
        return [
            'check 1' => [
                'expect' => '1 3 N'
            ],
            'check 2' => [
                'expect' => '5 1 N'
            ]
        ];
    }
}