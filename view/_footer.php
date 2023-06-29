    <footer class="footer">
        <div class="quote-container">
            <span id="quote-text">"Quizzes are not about being right or wrong; they're about learning and growth."</span>
        </div>
        <?php if (isset($_SESSION['id'])) echo '<form action="index.php?rt=index" method="post"><input type="submit" value="Log Out" name="logout" id="logout-button">'?>
    </footer>

    <script>
        var quotes = [
            "The only way to learn is to test yourself.",
            "The quiz is the tool that makes the lesson stick.",
            "A quiz is not only a tool for assessment; it's an opportunity for learning.",
            "Quizzes are like a mental workout, keeping your mind sharp and agile.",
            "Quizzes provide an opportunity to challenge yourself and push beyond your comfort zone.",
            "A well-designed quiz can reveal the depths of your knowledge and inspire further learning.",
            "Quizzes are not about being right or wrong; they're about learning and growth.",
            "The beauty of a quiz lies in the discovery of what you know and what you can still learn.",
            "Quizzes are like puzzle pieces that form a bigger picture of knowledge.",
            "A quiz is a journey of exploration, unlocking the doors to new understanding."
        ]; 

        let currentQuoteIndex = 0;
        const quoteTextElement = document.getElementById("quote-text");

        function changeQuote() {
            quoteTextElement.style.opacity = 0; 

            setTimeout(() => {
                currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length; 

                quoteTextElement.textContent = quotes[currentQuoteIndex];
                quoteTextElement.style.opacity = 1; 
            }, 1000); 
        }

        quoteTextElement.textContent = quotes[currentQuoteIndex];
        setInterval(changeQuote, 3000);
    </script>
</body>
</html> 