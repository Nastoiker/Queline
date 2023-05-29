export default function formatDate(date) {
    const now = new Date();
    const dateDiff = now - date;
    const minute = 60 * 1000;
    const hour = minute * 60;
    const day = hour * 24;
    const week = day * 7;
    if (dateDiff < minute) {
        return 'только что';
    } else if (dateDiff < hour) {
        const diff = Math.floor(dateDiff / minute);
        return `${diff} ${formatTimeWord('минут', diff)} назад`;
    } else if (dateDiff < day) {
        const diff = Math.floor(dateDiff / hour);
        return `${diff} ${formatTimeWord('час', diff)} назад`;
    } else if (dateDiff < week) {
        const diff = Math.floor(dateDiff / day);
        if (diff == 1) {
            return 'вчера';
        } else {
            return `${diff} ${formatTimeWord('день', diff)} назад`;
        }
    } else {
        const diff = Math.floor(dateDiff / week);
        return `${diff} ${formatTimeWord('недели', diff)} назад`;
    }
}

function formatTimeWord(word, count) {
    if (count % 10 == 1 && count != 11) {
        return word;
    } else if (count % 10 >= 2 && count % 10 <= 4 && (count < 10 || count > 20)) {
        return `${word}а`;
    } else {
        return `${word}ов`;
    }
}
