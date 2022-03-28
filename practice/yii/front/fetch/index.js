const delay = ms => {
    return new Promise(r => setTimeout(() => r(), ms))
}

const url = 'https://jsonplaceholder.typicode.com/todos'

async function fetchAsyncTodos() {
    const response = await fetch(url);
    const data = await response.json();
    console.log(data);
}

async function shotAfter5() {
    await delay(5000)
    console.log('shot after 5')
}

async function shotAfter2() {
    await delay(2000)
    console.log('shot after 2')
}

async function shotNow() {
    console.log('shot now')
}

shotAfter5();
shotAfter2();
shotNow();