'use strict';

const express = require('express');

const port = 3000;
const host = '0.0.0.0';

const { resolve } = require('path');
const { readdir } = require('fs').promises;

async function* getFiles(dir) {
    const directories = await readdir(dir, { withFileTypes: true });
    for (const directory of directories) {
        const res = resolve(dir, directory.name);
        if (directory.isDirectory()) {
            yield* getFiles(res);
        } else {
            yield res;
        }
    }
}

const app = express();
app.get('/', (req, res) => {
    res.send('Hello World');
});
app.listen(port, host);

(async () => {
    for await (const f of getFiles('test')) {
        console.log(f);
    }
})();