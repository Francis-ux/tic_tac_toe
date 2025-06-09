<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tic-Tac-Toe</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                margin-top: 50px;
            }

            .board {
                display: grid;
                grid-template-columns: repeat(3, 100px);
                gap: 5px;
            }

            .cell {
                width: 100px;
                height: 100px;
                background: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 2em;
                font-weight: bold;
                cursor: pointer;
            }

            .status {
                margin-top: 20px;
                text-align: center;
            }

            form {
                display: inline;
            }
        </style>
    </head>

    <body>
        <div>
            <div class="board">
                @foreach ($board as $i => $cell)
                    <form method="POST" action="{{ route('move') }}">
                        @csrf
                        <input type="hidden" name="index" value="{{ $i }}">
                        <button type="submit" class="cell"
                            {{ $cell || $winner ? 'disabled' : '' }}>{{ $cell }}</button>
                    </form>
                @endforeach
            </div>

            <div class="status">
                @if ($winner)
                    <h2>Player {{ $winner }} wins!</h2>
                @elseif (!in_array('', $board))
                    <h2>It's a draw!</h2>
                @else
                    <h3>Current Player: {{ $currentPlayer }}</h3>
                @endif
                <form method="POST" action="{{ route('reset') }}">
                    @csrf
                    <button type="submit">Reset Game</button>
                </form>
            </div>
        </div>
    </body>

</html>
