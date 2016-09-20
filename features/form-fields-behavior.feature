Feature: Show cached form field values to audience
	In order to test my application
	As a developer
	I need to be sure that previously filled in form fields are not filled in when revisiting a form

	Scenario: Proof that completely filled in form is submittable
		Given I am on "/plain-form"
		When I fill in the following:
		| first_name | Jeffrey 				 |
		| last_name  | Way     				 |
		| email      | jeffrey@laracasts.com |
		And I press "Submit"
		Then I should be on "/"
		And I should see "Laravel"

	Scenario: Proof that incompletely filled in form is not submittable
		Given I am on "/plain-form"
		When I fill in the following:
			| first_name | Jeffrey 				 |
			| last_name  | Way     				 |
		And I press "Submit"
		Then I should be on "/plain-form"
		And I should see "The email field is required."

	Scenario: Form fields, filled in previous scenarios should not be filled in in the next scenario
		Given I am on "/plain-form"
		When I fill in the following:
			| email | jeffrey@laracasts.com |
		And I press "Submit"
		Then I should be on "/plain-form"
		And I should see "The first name field is required."
		And I should see "The last name field is required."

	Scenario: Previously filled in form fields should not be filled in when revisiting the page
		Given I am on "/plain-form"
		When I fill in the following:
			| first_name | Jeffrey 				 |
			| last_name  | Way     				 |
		And I press "Submit"
		And I am on "/"
		And I should see "Laravel"
		And I am on "/plain-form"
		And I fill in "email" with "jeffrey@laracasts.com"
		And I press "Submit"
		And I should be on "/plain-form"
		Then I should see "The first name field is required."
		And I should see "The last name field is required."

