document.addEventListener("DOMContentLoaded", function () {
    const user = {
        name: "John Doe",
        email: "john.doe@example.com",
        profilePicture: "user.png",
    };

    const elections = [
        {
            id: 1,
            title: "Student Council Election",
            startDate: new Date("2023-12-10"),
            endDate: new Date("2023-12-15"),
        },
        {
            id: 2,
            title: "Club Committee Election",
            startDate: new Date("2023-12-17"),
            endDate: new Date("2023-12-22"),
        },
    ];

    const electionList = document.querySelector(".election-list");
    elections.forEach((election) => {
        const card = document.createElement("li");
        card.classList.add("election-card");

        const title = document.createElement("h3");
        title.classList.add("election-title");
        title.textContent = election.title;
        card.appendChild(title);

        const date = document.createElement("p");
        date.classList.add("election-date");
        date.textContent = `Voting starts on ${election.startDate.toLocaleDateString()} and ends on ${election.endDate.toLocaleDateString()}`;
        card.appendChild(date);

        const link = document.createElement("a");
        link.classList.add("btn", "btn-vote");
        link.textContent = "Vote Now";
        link.href = "../vp/vp.html"; 
        card.appendChild(link);

        electionList.appendChild(card);
    });
});
