function getBotResponse(input) {

  input = input.toLowerCase(); // convert input to lowercase

  // Student Dashboard
  if (["request for LOR", "lor request", "lor", "LOR", "LOR request", "Request for lor", "request for lor"  ].includes(input)) {
    return "Please fill out the form with your details, and the teacher will generate and send the LOR to you via mail. Link: <a href='http://localhost/smss/gen_lor4.php'>Click here</a> ";
  } else if (
    [
      "generate bonafide certificate",
      "bonafide certificate",
      "generate bonafide",
      "bonafide",
    ].includes(input)
  ) {
    return "A bonafide certificate is a document to certify the authenticity of a student's claims. You can generate them here: <a href='http://localhost/smss/bon_cer2.php'>Click here</a> ";
  } else if (
    [
      "generate medical certificate",
      "medical certificate",
      "generate medical",
      "medical",
    ].includes(input)
  ) {
    return "A medical certificate confirms a student's health status and may be required in cases of extended absences or illness-related academic accommodations. You can generate it here: <a href='http://localhost/smss/med_cer.php'>Click here</a>";
  } else if (
    [
      "study certificate",
      "course completion certificate",
      "generate course certificate",
      "course completion",
      "course",
      "study",
    ].includes(input)
  ) {
    return "Study Certificate is a document verifying that a student has successfully finished a course. Generate it here: <a href='http://localhost/smss/study_cer.php'>Click here</a>";
  } else if (
    [
      "generate resume",
      "resume generator",
      "resume builder",
      "resume",
    ].includes(input)
  ) {
    return "Please fill out the form with your details, and your desired resume will be generated in the most professional manner possible. Link: <a href='http://localhost/smss/res_cer2.php'>Click here</a>";
  } else if (
    ["manage profile", "update profile", "edit profile", "profile"].includes(input)
  ) {
    return "You can update your basic profile details in the Manage Profile section.";
  }
  // Simple responses
  if (["hello", "hi", "hii"].includes(input)) {
    return "Hello there! 👋";
    } else if (["goodbye", "bye"].includes(input)) {
    return "Talk to you later! 👋";
    } else if (["thank you", "thanks", "thanku", "thankyou"].includes(input)) {
    return "You're welcome! 😊";
    } else if (["how are you", "how r u"].includes(input)) {
    return "I'm doing well, thank you for asking! 😊";
    } else if (["what's up", "wassup"].includes(input)) {
    return "Not much, just here to chat with you! 😊";
    } else if (["who are you", "who r u"].includes(input)) {
    return "I'm your Chatbot a.k.a Assistant to answer all your queries, Nice to meet you! 😊";
    } else if (["what can you do", "what can u do"].includes(input)) {
    return "Ask me anything related to the Student Service Portal, and I will try to answer it 😎";
    } else if (["tell me a joke", "joke"].includes(input)) {
    return "Why did the tomato turn red? Because it saw the salad dressing! 😂";
    } else if (["meaning of life", "purpose of life"].includes(input)) {
    return "That's a difficult question to answer, as it depends on one's perspective and beliefs! 🤔";
    } else if (
    ["help", "contact support", "contact", "contact support", "mail"].includes(
    input
    )
    ) {
    return "If you need any help or have any feedback for us, <a href='http://localhost/smss/contactp.php'>Click here!</a> 📩";
    } else if (
    [
    "who developed",
    "developer",
    "developers",
    "creators",
    "who created",
    ].includes(input)
    ) {
    return "Meet the <a href='http://localhost/smss/about.php'>Developers</a> 🤝";
    } else if (
    [
    "services",
    "service",
    ].includes(input)
    ) {
    return 'You can:<div class="left-align"><ul class="bullet-points"><li>Request for <b>LOR</b></li><li>Generate <b>Bonafide</b> Certificate</li><li>Generate <b>Medical</b> Certificate</li><li>Generate <b>Study</b> Certificate</li><li>Make <b>Resume</b></li></ul></div>';
    
    } else {
    return "I'm sorry, I don't understand what you mean. Can you please rephrase or try something else? 🤔";
    }
}
