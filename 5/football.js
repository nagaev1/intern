function shuffleString(str) {
  return str
    .split("")
    .sort(() => 0.5 - Math.random())
    .join("");
}
const LIMIT = 7;
const TEAM_SIZE = 40;
const TEAMS_INEQUALITY = 0;
const GAMES_AMOUT = 10;
const TERMINAL_DANGER = "\x1b[31m";
const TERMINAL_RESET = "\x1b[0m";
const REGEX = new RegExp(`0{${LIMIT}}|1{${LIMIT}}`);

let teamsStr = "1".repeat(TEAM_SIZE) + "0".repeat(TEAM_SIZE);
console.log("Players: ", teamsStr);

for (let i = 1; i <= GAMES_AMOUT; i++) {
  teamsStr = shuffleString(teamsStr);
  let situationIndex = teamsStr.search(REGEX);

  if (situationIndex === -1) {
    console.log(`GAME ${i}: `, teamsStr, "\n NO");
  } else {
    let teamsColored = Array.from(teamsStr);
    let sliceIndex = situationIndex + LIMIT;
    while (situationIndex !== -1) {
      teamsColored[sliceIndex - LIMIT] =
        TERMINAL_DANGER + teamsColored[sliceIndex - LIMIT];
      teamsColored[sliceIndex - 1] += TERMINAL_RESET;

      situationIndex = teamsStr.slice(sliceIndex).search(REGEX);
      sliceIndex += situationIndex + LIMIT;
    }
    teamsColored = teamsColored.join("");
    console.log(`GAME ${i}: `, teamsColored, "\n YES");
  }
}
