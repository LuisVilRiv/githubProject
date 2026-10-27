<?php

namespace Tests\Feature;

use App\Models\Profesor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_profesor_can_be_created_viewed_updated_and_deleted(): void
    {
        $datos = [
            'nombre' => 'Ana',
            'apellidos' => 'García López',
            'especialidad' => 'Matemáticas',
            'fecha_alta' => '2020-09-01',
            'salario' => '2500.50',
        ];

        $this->get(route('profesor.index'))->assertOk();
        $this->get(route('profesor.create'))->assertOk();

        $this->post(route('profesor.store'), $datos)
            ->assertRedirect(route('profesor.index'));

        $profesor = Profesor::firstOrFail();
        $this->assertDatabaseHas('profesor', $datos);
        $this->get(route('profesor.show', $profesor))->assertOk();
        $this->get(route('profesor.edit', $profesor))->assertOk();

        $datos['especialidad'] = 'Física';
        $this->put(route('profesor.update', $profesor), $datos)
            ->assertRedirect(route('profesor.index'));
        $this->assertDatabaseHas('profesor', ['id' => $profesor->id, 'especialidad' => 'Física']);

        $this->delete(route('profesor.destroy', $profesor))
            ->assertRedirect(route('profesor.index'));
        $this->assertDatabaseMissing('profesor', ['id' => $profesor->id]);
    }

    public function test_profesor_rejects_a_negative_salary(): void
    {
        $this->from(route('profesor.create'))
            ->post(route('profesor.store'), [
                'nombre' => 'Ana',
                'apellidos' => 'García López',
                'especialidad' => 'Matemáticas',
                'fecha_alta' => '2020-09-01',
                'salario' => '-1',
            ])
            ->assertRedirect(route('profesor.create'))
            ->assertSessionHasErrors('salario');

        $this->assertDatabaseCount('profesor', 0);
    }
}
