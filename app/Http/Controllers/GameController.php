<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $board = session('board', array_fill(0, 9, ''));
        $currentPlayer = session('currentPlayer', 'X');
        $winner = $this->checkWinner($board);

        return view('game', compact('board', 'currentPlayer', 'winner'));
    }

    public function makeMove(Request $request)
    {
        $index = $request->input('index');
        $board = session('board', array_fill(0, 9, ''));
        $currentPlayer = session('currentPlayer', 'X');

        if ($board[$index] === '' && !$this->checkWinner($board)) {
            $board[$index] = $currentPlayer;
            $currentPlayer = $currentPlayer === 'X' ? 'O' : 'X';
        }

        session(['board' => $board, 'currentPlayer' => $currentPlayer]);
        return redirect('/');
    }

    public function resetGame()
    {
        session()->forget(['board', 'currentPlayer']);
        return redirect('/');
    }

    private function checkWinner($board)
    {
        $lines = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [2, 4, 6]
        ];

        foreach ($lines as $line) {
            [$a, $b, $c] = $line;
            if ($board[$a] !== '' && $board[$a] === $board[$b] && $board[$b] === $board[$c]) {
                return $board[$a];
            }
        }
        return null;
    }
}
