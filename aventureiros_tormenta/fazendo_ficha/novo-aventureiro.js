document.addEventListener('DOMContentLoaded', function() {
    const attributes = document.querySelectorAll('.attribute-circle:not(.center)');
    const remainingPointsDisplay = document.getElementById('remaining-points');
    let remainingPoints = 4;

    attributes.forEach(attribute => {
        // Add increase/decrease buttons
        const controls = document.createElement('div');
        controls.className = 'attribute-controls';
        controls.innerHTML = `
            <button class="decrease">-</button>
            <button class="increase">+</button>
        `;
        attribute.appendChild(controls);

        const valueDisplay = attribute.querySelector('.attr-value');
        let value = 1; // Starting value

        attribute.querySelector('.increase').addEventListener('click', () => {
            if (remainingPoints > 0 && value < 3) {
                value++;
                remainingPoints--;
                updateDisplay();
            }
        });

        attribute.querySelector('.decrease').addEventListener('click', () => {
            if (value > 0) {
                value--;
                remainingPoints++;
                updateDisplay();
            }
        });

        function updateDisplay() {
            valueDisplay.textContent = value;
            remainingPointsDisplay.textContent = remainingPoints;
            
            // Update button states
            attribute.querySelector('.increase').disabled = (remainingPoints === 0 || value === 3);
            attribute.querySelector('.decrease').disabled = (value === 0);
        }

        // Initial button states
        updateDisplay();
    });

    // Add styles for the controls
    const style = document.createElement('style');
    style.textContent = `
        .attribute-controls {
            position: absolute;
            bottom: -30px;
            display: flex;
            gap: 5px;
        }
        
        .attribute-controls button {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: none;
            background: #8b5cf6;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .attribute-controls button:disabled {
            background: #4a4a4a;
            cursor: not-allowed;
        }
        
        .attribute-controls button:hover:not(:disabled) {
            background: #7c4dff;
        }
    `;
    document.head.appendChild(style);
});
