package main

import (
	"fmt"
	"sync"
	"time"
)

func rangeGen(start, stop int) <-chan int {
	out := make(chan int)
	go func() {
		defer close(out)
		for i := start; i < stop; i++ {
			time.Sleep(50 * time.Millisecond)
			out <- i
		}

	}()
	return out
}

func merge(channels ...<-chan int) <-chan int {
	out := make(chan int)

	var mu sync.Mutex
	doneCounter := 0
	doneLimit := len(channels)

	for _, c := range channels {
		go func() {
			defer func() {
				mu.Lock()
				doneCounter++
				mu.Unlock()
			}()
			for v := range c {
				out <- v
			}
		}()
	}

	go func() {
		for {
			if doneCounter == doneLimit {
				close(out)
				return
			}
			continue
		}
	}()

	return out
}

func main() {
	in1 := rangeGen(11, 15)
	in2 := rangeGen(21, 25)
	in3 := rangeGen(31, 35)

	start := time.Now()
	merged := merge(in1, in2, in3)
	for val := range merged {
		fmt.Print(val, " ")
	}
	fmt.Println()
	fmt.Println("Took", time.Since(start))
}
