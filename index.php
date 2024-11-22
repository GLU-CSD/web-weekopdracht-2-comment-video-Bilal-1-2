<?php
include("reactions.php");

// Initialize variables
$errorMsg = "";
$successMsg = "";
$reactions = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (Reactions::setReaction($name, $email, $message)) {
            $successMsg = "Your reaction has been saved!";
        } else {
            $errorMsg = "Error saving your reaction. Please try again.";
        }
    } else {
        $errorMsg = "All fields are required.";
    }
}

// Fetch reactions to display
$reactions = Reactions::getReactions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Remake</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Embedded Video -->
    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=twI61ZGDECBr4ums"
        title="YouTube video player" frameborder="0" allowfullscreen></iframe>

    <!-- Reaction Form -->
    <div class="reaction-form">
        <h3>Leave a Reaction</h3>
        <?php if (!empty($errorMsg)): ?>
            <p style="color: red;"><?= htmlspecialchars($errorMsg) ?></p>
        <?php elseif (!empty($successMsg)): ?>
            <p style="color: green;"><?= htmlspecialchars($successMsg) ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Display Reactions -->
    <div class="reactions">
        <h3>User Reactions</h3>
        <?php if (!empty($reactions)): ?>
            <?php foreach ($reactions as $reaction): ?>
                <div class="reaction">
                    <strong><?= htmlspecialchars($reaction['name']) ?></strong> (<?= htmlspecialchars($reaction['email']) ?>)
                    <p><?= htmlspecialchars($reaction['message']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reactions yet. Be the first to comment!</p>
        <?php endif; ?>
    </div>
</body>

</html>
