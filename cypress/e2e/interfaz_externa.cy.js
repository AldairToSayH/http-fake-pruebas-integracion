describe('Agregar producto al carrito', () => {
    it('Debe agregar el producto blue top y mostrar popup Added', () => {
      cy.visit('/products')
  
      cy.contains('.productinfo', 'Blue Top')
        .parents('.single-products')
        .trigger('mouseover')
  
      cy.contains('Add to cart').click()
  
      cy.contains('Added').should('be.visible')
    })
  })