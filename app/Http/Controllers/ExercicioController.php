<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use App\Models\User;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    private function dadosTcc(): array
    {
        return [
            'nome' => 'IAFit',
            'subtitulo' => 'Sistema de Correção Postural e Monitoramento de Exercícios com Visão Computacional',
            'curso' => 'Ensino Médio Integrado ao Técnico em Desenvolvimento de Sistemas — ETEC Zona Leste',
            'problema' => 'A execução incorreta de exercícios físicos sem supervisão constante aumenta o risco de lesões musculares e articulares, além de reduzir a eficiência do treino.',
            'objetivo' => 'Desenvolver uma solução inteligente capaz de analisar a postura corporal em tempo real via câmera, calcular ângulos articulares e fornecer feedback imediato ao praticante.',
            'tecnologias' => [
                'Python + OpenCV (captura e processamento de vídeo em tempo real)',
                'YOLO Pose (detecção de keypoints corporais e cálculo de ângulos)',
                'Laravel 11 + Breeze + Tailwind CSS (gestão web, autenticação e CRUD)',
                'Banco de Dados Relacional / Firestore (armazenamento de exercícios e histórico)',
            ],
            'diferenciais' => [
                'Feedback postural instantâneo sem necessidade de sensores vestíveis.',
                'Contagem automática de repetições válidas baseada em ângulos biomecânicos.',
                'Painel administrativo para cadastro e calibração dos parâmetros de cada exercício.',
            ],
        ];
    }

    public function home()
    {
        $tcc = $this->dadosTcc();
        $exercicios = Exercicio::orderBy('id', 'asc')->get();

        return view('welcome', compact('tcc', 'exercicios'));
    }

    public function dashboard()
    {
        $tcc = $this->dadosTcc();
        $exercicios = Exercicio::latest()->get();

        $metricas = [
            'total_exercicios' => $exercicios->count(),
            'ativos' => $exercicios->where('ativo', true)->count(),
            'iniciantes' => $exercicios->where('dificuldade', 'Iniciante')->count(),
            'intermediarios' => $exercicios->where('dificuldade', 'Intermediário')->count(),
            'avancados' => $exercicios->where('dificuldade', 'Avançado')->count(),
            'total_usuarios' => User::count(),
        ];

        return view('dashboard', compact('tcc', 'exercicios', 'metricas'));
    }

    public function index()
    {
        $exercicios = Exercicio::latest()->get();
        return view('exercicios.index', compact('exercicios'));
    }

    public function create()
    {
        return view('exercicios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:120',
            'grupo_muscular' => 'required|string|max:120',
            'articulacoes_monitoradas' => 'required|string|max:200',
            'angulo_ideal' => 'required|string|max:150',
            'dificuldade' => 'required|in:Iniciante,Intermediário,Avançado',
            'descricao_correcao' => 'required|string',
        ]);

        $validated['ativo'] = $request->has('ativo');

        Exercicio::create($validated);

        return redirect()->route('exercicios.index')
            ->with('success', 'Exercício cadastrado com sucesso no IAFit!');
    }

    public function show(Exercicio $exercicio)
    {
        return view('exercicios.edit', compact('exercicio'));
    }

    public function edit(Exercicio $exercicio)
    {
        return view('exercicios.edit', compact('exercicio'));
    }

    public function update(Request $request, Exercicio $exercicio)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:120',
            'grupo_muscular' => 'required|string|max:120',
            'articulacoes_monitoradas' => 'required|string|max:200',
            'angulo_ideal' => 'required|string|max:150',
            'dificuldade' => 'required|in:Iniciante,Intermediário,Avançado',
            'descricao_correcao' => 'required|string',
        ]);

        $validated['ativo'] = $request->has('ativo');

        $exercicio->update($validated);

        return redirect()->route('exercicios.index')
            ->with('success', 'Exercício atualizado com sucesso!');
    }

    public function destroy(Exercicio $exercicio)
    {
        $exercicio->delete();

        return redirect()->route('exercicios.index')
            ->with('success', 'Exercício removido com sucesso!');
    }
}