<?php


class FormFieldsBehaviorTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_not_cache_input_values_when_revisiting_the_form()
    {
        $this->visitForm();

        $this->fillOutFormExceptForEmail();
        $this->press('Submit')
            ->see('The email field is required.')
            ->dontSee('The first name field is required.');

        $this->changePageAndRevisitTheForm();

        $this->fillOutOnlyEmail();
        // if the old form fields first_name and last_name would still be filled in, the form would submit.
        $this->press('Submit')
             ->see('The first name field is required.');
        $this->assertFailure();
    }
    private function visitForm()
    {
        $this->visit('/plain-form');
    }
    private function fillOutFormExceptForEmail()
    {
        $this->fillOutForm(['first_name' => 'Jeffrey', 'last_name' => 'Way']);
    }
    private function fillOutForm($fieldsToFill)
    {
        foreach ($fieldsToFill as $element => $value) {
            $this->type($value, $element);
        }
    }
    private function changePageAndRevisitTheForm()
    {
        $this->visit('/')
            ->visit('/plain-form');
    }
    private function fillOutOnlyEmail()
    {
        $this->fillOutForm(['email' => 'jeffrey@laracasts.com']);
    }
    private function assertFailure()
    {
        // when the form was submitted successfully, the controller redirects back to '/'
        // we don't expect that:
        $this->dontSee('Laravel');
    }
    /**
     * @test
     */
    public function it_should_submit_the_form_when_filled_in_completely_in_one_step()
    {
        // just to proof that the form is in fact submittable.
        $this->visitForm();
        $this->fillFormCompletely();
        $this->press('Submit');
        $this->assertSuccess();
    }
    private function fillFormCompletely()
    {
        $this->fillOutForm(['first_name' => 'Jeffrey', 'last_name' => 'Way', 'email' => 'jeffrey@laracasts.com']);
    }
    private function assertSuccess()
    {
        // when the controller redirects to '/', we're asserting success
        $this->see('Laravel');
    }
}
