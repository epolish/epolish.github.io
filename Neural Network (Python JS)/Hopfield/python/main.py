import numpy as np
from functools import reduce

def main():
    X = np.array([[[1, 1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, 1, 1]],
        [[1, 1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1]],
        [[-1, 1, 1, 1, -1, 1, 1, -1, 1, 1, 1, 1, 1, -1, 1]]]);
    Y = np.array([[1, 1, -1, 1, -1, 1, 1, -1, 1, 1, -1, 1, 1, -1, 1]]);
    func = np.vectorize(lambda x: x < 0 and -1 or 1)
    W = func(reduce(lambda y, x: np.add(y, np.dot(x.transpose(), x)), X))
    np.fill_diagonal(W, 0)
    print(np.array_equal(X[1], func(np.dot(Y, W))))

if __name__ == '__main__':
    main()