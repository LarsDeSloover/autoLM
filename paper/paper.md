---
title: 'autoLM: AI-Driven Collective Response Synthesis'
tags:
  - Large Language Models
  - Natural Language Processing
  - participatory systems
  - collective knowledge
authors:
  - name: Lars De Sloover
    affiliation: 1
  - name: Bart De Wit
    affiliation: 1
  - name: Haosheng Huang
    affiliation: 1
  - name: Nico Van de Weghe
    affiliation: 1
affiliations:
  - name: Department of Geography, Ghent University, Ghent, Belgium
    index: 1
date: 20 December 2024
bibliography: paper.bib
---

# Summary

autoLM is an innovative web-based tool designed to synthesize responses from groups of participants using generative artificial intelligence (GenAI). Drawing inspiration from participatory approaches where collective input leads to richer insights, autoLM employs large language models to process and analyze multiple individual responses to open-ended questions. The system allows instructors or facilitators to pose questions through a user-friendly interface to which participants can provide their responses. Instructors can customize the synthesis parameters by modifying the prompt that drives the AI analysis, enabling different types of response aggregation based on their specific needs. autoLM uses the OpenAI API to process these individual responses in real-time and generate a synthesis that captures both common themes and different perspectives. This approach acknowledges that valuable insights often emerge from analyzing both the convergence and divergence in group responses. By providing instant syntheses of participant input, autoLM facilitates more efficient and inclusive group discussions. It enables moderators to quickly identify shared viewpoints as well as unique contributions, making it particularly valuable for educational settings where understanding the full spectrum of responses enriches the learning experience. Moreover, the tool increases student participation by lowering the threshold to contribute - students can share their thoughts more freely knowing their individual responses will be part of a larger synthesis rather than being put on the spot individually.

# Statement of Need

In educational settings, instructors frequently use audience response systems (ARS), commonly known as "clickers," and other interactive platforms to collect student input and enable formative assessment [@beatty:2009; @caldwell:2007; @wang:2020]. While an ARS can efficiently collect quantitative data for immediate feedback and promote student engagement [@goksun:2019], they often fail to capture the depth and nuance of student perspectives on complex topics [@kay:2009]. While open-response features in modern ARS platforms allow for qualitative input, processing these responses is time-consuming and overwhelming in large classes, making it challenging for instructors to synthesize key themes in a timely manner [@draper:2004; @martin:2024]. Interactive features that use natural language processing (NLP) techniques, such as automatic word clouds [@herrada:2020], highlight frequent terms but often disregard the context and subtleties of individual contributions, leading to an oversimplified understanding of student comprehension [@gao:2024]. The manual effort required to analyze the data from these formative assessment tools is time-consuming and can introduce bias, as instructors may unconsciously focus on responses that confirm their expectations or overlook divergent viewpoints [@gao:2024; @martin:2024].

autoLM addresses these challenges by leveraging GenAI to automate the synthesis of open-ended responses. By processing individual inputs through advanced language models [@kasneci:2023], autoLM provides instant, comprehensive summaries that capture both common themes and unique perspectives. This approach preserves the richness of individual contributions while enabling instructors to quickly grasp the full spectrum of student feedback. The ability to customize prompts allows educators to tailor the analysis to specific contexts, increasing the tool's adaptability and effectiveness in synthesizing collective insights.

# Functionality of the Website

autoLM provides instructors with an intuitive web interface (<https://autolm.ugent.be/>) to create surveys with up to three open-ended questions. For each question, instructors can customize the system prompt that guides the synthesis process, with a default prompt available for convenience. Once the survey is prepared, the instructor can launch it with a simple click and generate a QR code for students to scan with their mobile devices. As responses are collected, the instructor can generate or regenerate the synthesized output on the fly, enabling real-time engagement and discussion. Readers are encouraged to visit the website (<https://autolm.ugent.be/>) to explore the interface and its functionalities firsthand.

autoLM leverages GPT-4o-mini, a state-of-the-art language model offering an optimal balance between performance and cost-efficiency. This model was chosen for its fast processing speed, relatively low cost, and substantial context window of 128,000 tokens, making it well-suited for real-time classroom applications [openai:2024]. Through the API, the model analyzes the collected input and creates a summary that captures the group's key themes and unique insights. The flexibility to stop the survey at any time gives instructors full control over the participation window; once stopped, students can no longer submit responses.

By automating the analysis of open-ended feedback, autoLM enhances engagement and streamlines the integration of diverse student contributions into the learning process. The use of GPT-4o-mini ensures high-quality synthesis, making it a powerful tool for facilitating effective and inclusive discussions.

# Use in Teaching and Learning Situations

autoLM is particularly valuable in a variety of teaching and learning contexts. In large lectures or online courses, where individual student engagement can be challenging, it encourages broad participation by allowing every student to contribute their thoughts on open-ended questions. Instructors can use the synthesized summaries to quickly understand the collective viewpoints of the class, identify misunderstandings, and adjust their teaching strategies accordingly. In smaller group discussions, autoLM can highlight diverse perspectives to stimulate deeper dialog and critical thinking. The tool also supports formative assessment by providing immediate insights into student understanding and allowing teachers to immediately address gaps in knowledge. By integrating autoLM into their pedagogical practices, educators can enhance interaction, promote reflective learning, and foster a collaborative educational environment.

# Story of the Project

autoLM originated from the concept of collective truth in Public Participation Geographic Information Systems (PPGIS) and demonstrates that overlaying numerous individual map-based responses —each with their own inaccuracies— can reveal a more accurate collective understanding [@brown:2012; @elwood:2008; @ramirez:2021]. This idea inspired the development of the Less Is More (LIM) method [@vervaet:2024], which aims to collect comprehensive subjective and spatiotemporal information through concise online questionnaires with mainly open-ended questions and a user-friendly interface.

The "LM" in autoLM not only stands for Language Model, but also refers to the Less Is More philosophy. Initially, the LIM method used classic NLP techniques to analyze open-ended responses. Recognizing that this approach could be improved upon, autoLM was developed to leverage advanced language models to synthesize collective input. By integrating generative AI, autoLM streamlines the analysis process and captures richer insights from participant responses. In doing so, autoLM builds on the fundamental principles of collective truth and the LIM method to facilitate a deeper understanding upon synthesizing perspectives.

# References
