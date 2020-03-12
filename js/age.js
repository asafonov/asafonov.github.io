function calcAge() {
    var dateOfBirth = 401252400;
    var now = (new Date()).getTime() / 1000;
    var age = now - dateOfBirth;
    var secondsInYear = 365.25 * 3600 * 24;
    var secondsInMonth = 365.25 / 12 * 3600 * 24;
    var years = parseInt(age / secondsInYear);
    var months = parseInt((age - years * secondsInYear) / secondsInMonth);
    var days = parseInt((age - years * secondsInYear - months * secondsInMonth) / 3600 / 24);
    return years + ' years ' + months + ' months and ' + days + ' days';
}
