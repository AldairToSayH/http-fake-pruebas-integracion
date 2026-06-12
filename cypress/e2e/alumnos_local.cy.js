describe('Registro de alumnos en la interfaz del proyecto', () => {
    it('registra un alumno y lo muestra en la tabla', () => {
        const suffix = Date.now()
        const codigo = `A${suffix}`
        const email = `lucia${suffix}@instituto.edu`

        cy.visit('/alumnos-ui')

        cy.get('[data-cy="codigo"]').type(codigo)
        cy.get('[data-cy="nombre"]').type('Lucía Ramos')
        cy.get('[data-cy="email"]').type(email)
        cy.get('[data-cy="btn-guardar"]').click()

        cy.contains('Alumno registrado correctamente')
        cy.contains('Lucía Ramos')
        cy.contains(email)
        cy.contains('activo')
    })

    it('muestra errores cuando faltan campos obligatorios', () => {
        cy.visit('/alumnos-ui')

        cy.get('[data-cy="btn-guardar"]').click()

        cy.contains('The codigo field is required')
        cy.contains('The nombre field is required')
        cy.contains('The email field is required')
    })
})
