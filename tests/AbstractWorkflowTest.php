<?php declare(strict_types=1);

use Stubs\TestAbstractWorkflow;
use Stubs\WorkflowWithParameter;
use Sassnowski\Venture\Facades\Workflow;
use Sassnowski\Venture\Models\Workflow as WorkflowModel;
use function PHPUnit\Framework\assertInstanceOf;

uses(TestCase::class);

it('can be started', function () {
    Workflow::fake();

    $workflow = TestAbstractWorkflow::start();

    assertInstanceOf(WorkflowModel::class, $workflow);
    Workflow::assertStarted(TestAbstractWorkflow::class);
});

it('passes the parameters to the constructor of the workflow', function () {
    Workflow::fake();

    WorkflowWithParameter::start('::param::');

    Workflow::assertStarted(WorkflowWithParameter::class, function (WorkflowWithParameter $workflow) {
        return $workflow->something === '::param::';
    });
});
