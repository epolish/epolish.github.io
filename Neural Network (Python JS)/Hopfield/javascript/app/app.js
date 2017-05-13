(function() {
    document.addEventListener('DOMContentLoaded', function() {
        var X = [
            [[1, 1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, 1, 1]],
            [[1, 1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1]],
            [[-1, 1, 1, 1, -1, 1, 1, -1, 1, 1, 1, 1, 1, -1, 1]]
        ],
        Y = [[1, 1, -1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1]];
        this.getElementById('content').innerHTML = 'X' + (Hopfield.solve(X, Y) + 1);
    });
}());