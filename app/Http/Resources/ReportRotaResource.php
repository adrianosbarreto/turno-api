<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportRotaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'rota_id' => $this->id,
            'nome' => $this->nome,
            'tipo' => $this->tipo,
            'hora_ida_inicio' => $this->hora_ida_inicio,
            'hora_ida_termino' => $this->hora_ida_termino,
            'hora_volta_inicio' => $this->hora_volta_inicio,
            'hora_volta_termino' => $this->hora_volta_termino,
            'escolas' => $this->alunos->groupBy('escola.nome')->map(function ($alunos, $escolaNome) {
                $escola = $alunos->first()->escola;
                return [
                    'escola' => $escolaNome,
                    'endereco' => $escola ? $escola->endereco : '',
                    'cidade' => $escola ? $escola->cidade : '',
                    'estado' => $escola ? $escola->estado : '',
                    'cep' => $escola ? $escola->cep : '',
                    'alunos' => $alunos->map(function ($aluno) {
                        return [
                            'id' => $aluno->id,
                            'nome' => $aluno->nome,
                            'serie' => $aluno->serie,
                            'ensino' => $aluno->ensino,
                            'turno' => $aluno->turno,
                            'cep' => $aluno->cep,
                            'endereco' => $aluno->endereco,
                            'bairro' => $aluno->bairro,
                            'numero' => $aluno->numero,
                            'complemento' => $aluno->complemento,
                            'cidade' => $aluno->cidade,
                            'sexo' => $aluno->sexo,
                            'estado' => $aluno->estado,
                            'hora_ida' => $aluno->hora_ida,
                            'hora_volta' => $aluno->hora_volta,
                        ];
                    }),
                ];
            })->values(),
        ];
    }
}
