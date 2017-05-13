function Matrix() {};

Matrix.transpose = function(A) {
    var i,
        j,
        m = A.length,
        n = A[0].length,
        AT = [];
    for(i = 0; i < n; i++) {
        AT[i] = [];
        for(j = 0; j < m; j++) {
            AT[i][j] = A[j][i];
        }
    }
    return AT;
};

Matrix.sum = function (A, B) {
    var i,
        j,
        m = A.length,
        n = A[0].length,
        C = [];
    for(i = 0; i < m; i++) {
        C[i] = [];
        for(j = 0; j < n; j++) {
            C[i][j] = A[i][j] + B[i][j];
        }
    }
    return C;
};

Matrix.dot = function(A, B) {
    var i,
        j,
        k,
        t,
        rowsA = A.length,
        colsA = A[0].length,
        rowsB = B.length,
        colsB = B[0].length,
        C = [];
    if(colsA !== rowsB) {
        return false;
    }
    for(i = 0; i < rowsA; i++) {
        C[i] = [];
    }
    for(k = 0; k < colsB; k++) {
        for(i = 0; i < rowsA; i++) {
            t = 0;
            for(j = 0; j < rowsB; j++) {
                t += A[i][j] * B[j][k];
            }
            C[i][k] = t;
        }
    }
    return C;
};

Matrix.fillDiagonal = function(A, num = 0) {
    var i = 0,
        j = 0,
        m = A.length,
        n = A[0].length,
        C = [];
    for(i = 0; i < m; i++) {
        C[i] = [];
        for(j = 0; j < n; j++) {
            C[i][j] = i === j ? num : A[i][j];
        }
    }
    return C;
};

Matrix.vectorize = function(A) {
    var i,
        j,
        m = A.length,
        n = A[0].length,
        C = [];
    for(i = 0; i < m; i++) {
        C[i] = [];
        for(j = 0; j < n; j++) {
            C[i][j] = A[i][j] < 0 ? -1 : 1;
        }
    }
    return C;
};

Matrix.arrayEqual = function(A, B) {
    var i,
        j,
        m = A.length,
        n = A[0].length;
    if(m !== B.length || n !== B[0].length) {
        return false;
    }
    for(i = 0; i < m; i++) {
        for(j = 0; j < n; j++) {
            if (A[i][j] !== B[i][j]) {
                return false;
            }
        }
    }
    return true;
};