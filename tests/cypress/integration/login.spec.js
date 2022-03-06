/// <reference types="cypress" />

describe('login', () => {
    it('shows login page', () => {
        cy.visit('/login');
    })
})
