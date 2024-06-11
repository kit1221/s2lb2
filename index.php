<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mongo</title>
</head>
<body>
    <h3>Таблиця чемпіонату для обраної ліги</h3>
    <div>
        <form method="post" action="getTableOfChampionship.php">
            <label for="league">Оберіть лігу:</label>
            <select name="league" id="league">
                <?php
                include('connect.php');
                $cursor = $games_collection->distinct('league');
                foreach ($cursor as $document) {
                    echo '<option value="' . $document . '">' . $document . '</option>';
                }
                ?>
            </select>
            <button type="submit">Опрацювати</button>
        </form>
        <div id="gamesTable"></div>
    </div>

    <h3>Список футболістів зазначеної команди</h3>
    <div>
        <form method="post" action="getPlayersOfTeam.php">
            <label for="team">Оберіть команду:</label>
            <select name="team" id="team">
                <?php
                $cursor = $teams_collection->distinct('name');
                foreach ($cursor as $document) {
                    echo '<option value="' . $document . '">' . $document . '</option>';
                }
                ?>
            </select>
            <button type="submit">Опрацювати</button>
        </form>
        <ul id="playersList"></ul>
    </div>

    <h3>Список ігор, у яких брала участь обрана команда</h3>
    <div>
        <form method="post" action="getGamesByTeam.php">
            <label for="team_game">Оберіть команду:</label>
            <select name="team" id="team_game">
                <?php
                $cursor = $games_collection->distinct('teams');
                foreach ($cursor as $document) {
                    echo '<option value="' . $document . '">' . $document . '</option>';
                }
                ?>
            </select>
            <button type="submit">Опрацювати</button>
        </form>
        <ul id="gamesList"></ul>
        
    </div>


    <script>
    var gamesData = JSON.parse(localStorage.getItem('games'));
    if (gamesData) {
        var gamesList = document.getElementById('gamesList');
        gamesData.forEach(function(game) {
            var li = document.createElement('li');
            li.textContent = game.league + ' - ' + game.date + ' - ' + game.location + ' - Переможець: ' + game.winner;
            gamesList.appendChild(li);
        });
    } else {
        document.write("Немає даних про ігри");
    }

    var playersData = JSON.parse(localStorage.getItem('players'));
    if (playersData) {
        var playersList = document.getElementById('playersList');
        playersData.forEach(function(player) {
            var li = document.createElement('li');
            li.textContent = player;
            playersList.appendChild(li);
        });
    } else {
        document.write("Немає даних про гравців");
    }

    var gamesTableData = JSON.parse(localStorage.getItem('gamesTable'));
    if (gamesTableData) {
        var gamesTableDiv = document.getElementById('gamesTable');
        var table = document.createElement('table');
        table.border = '1';
        var headerRow = table.insertRow(0);
        headerRow.innerHTML = '<th>Ліга</th><th>Дата</th><th>Місце проведення</th><th>Команди</th><th>Переможець</th>';
        gamesTableData.forEach(function(game) {
            var row = table.insertRow(-1);
            var teams = game.teams.join(', ');
            row.innerHTML = '<td>' + game.league + '</td><td>' + game.date + '</td><td>' + game.location + '</td><td>' + teams + '</td><td>' + game.winner + '</td>';
        });
        gamesTableDiv.appendChild(table);
    } else {
        document.write("Немає даних про таблицю чемпіонату");
    }
</script>
</body>
</html>