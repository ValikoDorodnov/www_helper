class Word {
    addSome(char) {
        return char + 'test';
    }
}

let word = new Word();

let input = document.querySelector('#test-input'),
    output = document.querySelector('#test-output');

if (input) {
    input.addEventListener('change', () => {
        let res = '';
        res = word.addSome(input.value)

        output.innerHTML = res;
    });
}