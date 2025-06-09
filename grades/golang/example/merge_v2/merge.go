package main

import (
	"fmt"
	"sync"
	"time"
)

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
	var wg sync.WaitGroup
	wg.Add(len(channels))

	out := make(chan int)
	for _, ch := range channels {
		go func() {
			for val := range ch {
				out <- val
			}
			wg.Done()
		}()
	}

	go func() {
		wg.Wait()
		close(out)
	}()

	return out
}
