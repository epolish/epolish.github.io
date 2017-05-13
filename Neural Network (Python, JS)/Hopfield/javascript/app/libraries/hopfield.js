var Hopfield = Object.create(Matrix);

Hopfield.solve = function(X, Y) {
    var i,
        n,
        W,
        Rez,
        array = [],
        m = X.length;
    for(i = 0; i < m; i++) {
        array[i] = this.dot(this.transpose(X[i]), X[i]);
    }
    W = array[0];
    n = array.length - 1;
    for(i = 0; i < n; i++) {
        W = this.sum(W, array[i + 1]);
    }
    W = this.fillDiagonal(this.vectorize(W));
    Rez = this.vectorize(this.dot(Y, W));
    for(i = 0; i < m; i++) {
        if(this.arrayEqual(Rez, X[i])) {
            return i;
        }
    }
    return false;
};