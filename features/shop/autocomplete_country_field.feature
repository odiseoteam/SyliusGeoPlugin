@geo
Feature: Autocomplete country field
    In order to select my country
    I want to be able to view it

    Background:
        Given the store operates on a single channel in "United States"
        And the store also has country "Australia"
        And the store has a product "PHP T-Shirt" priced at "$19.99"

    @ui
    Scenario: Completing shipping address from address step
        Given I have product "PHP T-Shirt" in the cart
        And I am at the checkout addressing step
        When I shop from Australia
        Then I should have "Australia" selected as country
